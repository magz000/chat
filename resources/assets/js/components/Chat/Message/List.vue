<template >
    <div class="__message-cont p-0">
        <div class="__header">
            {{ title }}

            <i v-if="type == 'conversation'" class="fa fa-ellipsis-v" data-toggle="dropdown"></i>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a v-if="!conversation.private" class="dropdown-item" href="#" @click="updateTitle">
                    Change Title
                </a>

                <a v-if="!conversation.private" class="dropdown-item" href="#" @click="add">
                    Add Participant
                </a>

                <a class="dropdown-item" href="#" @click="showUsers">
                    Show Participants
                </a>

            </div>
        </div>


        <div class="__message-list">
            <div class="typing"><center> <span class="badge badge-primary" v-if="typing.message.length">{{ typing.user }} is typing</span> </center> </div>

            <message v-for="(msg,index) in messagesSorted"
                        :key="index"
                        :message="msg"
                        :prev="messagesSorted[index+1]"></message>

            <div v-if="loading"><center><i class="fa fa-spinner fa-pulse"></i></center></div>
        </div>

        <message-input :conversation="conversation"></message-input>

        <change-title-modal v-if="type == 'conversation'" ref="changeTitle" :conversation="conversation"></change-title-modal>

        <add-user ref="addUser" :conversation="conversation"></add-user>
    </div>
</template>

<script>
import Message from './Message'
import MessageInput from './MessageInput'
import ChangeTitleModal from './ChangeTitleModal'
import AddUser from './AddUser'
export default {
    // props: ['conversation'],
    components: {
        Message, MessageInput, ChangeTitleModal, AddUser
    },
    data() {
        return {
            messages: [],
            page: 1,
            loading: false,
            typing: {
                user: '',
                message: '',
            },
            timeout: null,
        }
    },
    watch: {
        'conversation.id': {
            immediate: true,
            handler: function(val, old){
                Echo.leave('conversation.' + old)


                this.page = 1,
                this.messages = []

                if(this.type == 'conversation') {
                    this.loadMessages()

                    if(this.conversation.unread) {
                        this.markAsRead()
                        this.conversation.unread = 0
                    }

                    this.listen(val)
                }

            }
        },
    },
    mounted() {
        $( ".__message-list" ).scroll(() =>{
            if($( ".__message-list" ).scrollTop() == 0) {
                this.loadMessages()
            }
        })
    },
    methods: {
        loadMessages() {
            if(!this.loading) {
                this.loading = true

                chatService.getMessages(this.conversation.id, this.page)
                .then(response => {
                    this.loading = false
                    this.messages = _.concat(this.messages, response.data.data)
                    if(response.data.data.length){
                        this.page++
                    }
                })
                .catch(error => {
                    this.loading = false
                    console.log(error)
                })
            }

        },
        scrollToBottom(){
            var target = $('.__message-list')
            target.animate({scrollTop:  target[0].scrollHeight}, 100);
        },
        listen(id) {
            Echo.private('conversation.' + id)
                .listen('SendMessage', (e) => {
                    this.messages.push(e.message)
                    this.scrollToBottom()
                })
                .listenForWhisper('typing', (e) => {
                    clearTimeout(this.timeout)
                    this.typing = e
                    this.scrollToBottom()

                    this.timeout = setTimeout(() => {
                        this.typing = {
                            user: '',
                            message: '',
                        }
                    }, 3000)

                })
        },
        markAsRead() {
            chatService.markAsRead(this.conversation.id)
                .then(response => {
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        showUsers() {
            $('#user-list-modal').modal('show')
        },
        updateTitle() {
            // console.log('MOTHAFUCKA')
            $(this.$refs.changeTitle.$el).modal('show')
        },
        add() {
            $(this.$refs.addUser.$el).modal('show')
        },

        // createGroupChat() {
        //     /*TODO make user on selectedConversation automatically added*/
        //     $('#create-groupchat-modal').modal('show')
        // }
    },
    computed: {
        messagesSorted() {
            return _.orderBy(this.messages, ['created_at'], ['desc'])
        },
        title(){

            if(this.type == 'conversation') {
                if(this.conversation.data.title) {
                    return this.conversation.data.title
                }else{
                    var users = _.filter(this.conversation.users, (u) => {
                        return u.id != this.user.id
                    })

                    return _.join(_.map(users.slice(0, 3), 'name'), ', ')
                                        + (users.length > 3 ? ', +'
                                        + (users.length - 3)
                                        + ' more users': '')
                }
            } else if(this.type == 'user'){
                return this.conversation.first_name +' '
                                + this.conversation.last_name
            } else if(this.type == 'users') {
                var users = _.filter(this.conversation, (u) => {
                    return u.id != this.user.id
                })

                return _.join(_.map(users.slice(0, 3), 'name'), ', ')
                                    + (users.length > 3 ? ', +'
                                    + (users.length - 3)
                                    + ' more users': '')
            }
        },
        user() {
            return this.$store.getters.user
        },
        conversation() {
            return this.$store.getters.selectedConv
        },
        type() {
            return this.$store.getters.selectedConvType
        },
    }
}
</script>

<style lang="scss" scoped>


ul {
    list-style: none;
    padding-left: 0px;
    margin-bottom: 0px;
}

.fa-spinner {
    font-size: 40px;
    color: #ccc;
    margin: 16px;
}

.__message-cont {
    display: flex;
    flex-direction: column;
    // border-right: 1px solid #ccc;

    .__header {
        padding: 5px 16px;
        font-size: 14px;
        background: #fff;
        border-bottom: 1px solid #ccc;


        i {
            float: right;
            margin-top: 5px;
            color: #ddd;
            cursor: pointer;
            width: 20px;
            text-align: center;

            &:hover {
                color: #aaa;
            }
        }
    }

    .__message-list {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        display: flex;
        flex-direction: column-reverse;

        &::-webkit-scrollbar {
            width: 4px;
        }

        &::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        &::-webkit-scrollbar-thumb {
            background: #888;
        }

        &::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    }

    .__input-cont {
        width: 100%;
        padding: 5px 10px;
        display: flex;
        flex-direction: row;

        .__attach, .__send {
            width: 40px;
            font-size: 20px;
            text-align: center;
            color: #bbb;
            transform: rotate(45deg);
            &:hover {
                color: #555;
            }
        }


        input {
            flex: 1;
        }
    }

}
</style>
