<template>
    <div class="container">
        <div class="row justify-content-center h-100">
            <div class="col-md-3 user-cont">
                <button class="btn btn-primary" @click="addUser">Add User</button>
                <ul>
                    <user v-for="(usr, index) in conversation.users"
                            :key="index"
                            :user="usr"
                            :online="online"></user>

                    <!-- -->
                </ul>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ title }}

                        <i class="fa fa-ellipsis-v option"  data-toggle="dropdown"></i>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#" @click="changeTitle">Edit</a>
                        </div>

                    </div>
                    <div class="card-body messages-cont" style="overflow: auto;">
                        <ul>
                            <li v-if="loading"><center><i class="fa fa-spinner fa-pulse"></i></center></li>

                            <message v-for="(msg,index) in messagesSorted"
                                        :key="index"
                                        :message="msg"></message>

                        </ul>
                        <div class="typing"><center> <span class="badge badge-primary" v-if="typing.message.length">{{ typing.user }} is typing</span> </center> </div>

                    </div>
                    <div class="card-footer">

                        <button class="btn btn-primary" style="float: right;" @click="sendFile" v-if="fileCont">Send File</button>
                        <button class="btn btn-danger mr-1" style="float: right;" @click="removeFile" v-if="fileCont">Remove</button>
                        <input id="file-input" type="file" class="form-control-file w-50" @change="processFile">

                        <input v-if="!fileCont" class="form-control mt-1" @keypress.enter="send" v-model="message">
                    </div>
                </div>
            </div>
        </div>

        <change-title :conversation="conversation"></change-title>
        <add-user :conversation="conversation"></add-user>
    </div>
</template>

<script>
    import User from './Sub/User.vue'
    import Message from './Sub/Message.vue'
    import ChangeTitle from './Sub/ChangeTitleModal.vue'
    import AddUser from './Sub/AddUser.vue'
    export default {
        props: ['user', 'conversationOrig', 'messagesOrig'],
        components: {
            'user': User,
            'change-title': ChangeTitle,
            'message': Message,
            'add-user': AddUser,
        },
        data() {
            return {
                conversation: this.conversationOrig,
                message: null,
                messages: this.messagesOrig,
                online: [],
                typing: {
                    user: '',
                    message: '',
                },
                fileCont: null,
                loading: false,
                page: 2,

            }
        },
        watch: {
            message(){
                Echo.private('conversation.' + this.conversation.id)
                    .whisper('typing', {
                        user: this.user.first_name +' '+ this.user.last_name,
                        message: this.message,
                    })
                    // this.scrollToBottom()
            }
        },
        mounted() {

            $( ".messages-cont" ).scroll(() =>{
                if($( ".messages-cont" ).scrollTop() == 0) {
                    this.loadMessages()
                }
            })

            this.scrollToBottom()
            // this.loadMessages()


            Echo.private('conversation.' + this.conversation.id)
                .listen('SendMessage', (e) => {
                    console.log(e.message)
                    this.messages.push(e.message)
                    this.scrollToBottom()
                })
                .listenForWhisper('typing', (e) => {
                    this.typing = e
                    this.scrollToBottom()
                })

            Echo.join('conversation.' + this.conversation.id)
                .here((users) => {
                    _.each(users, (user) => {
                        var curr = _.find(this.conversation.users, (us) => {
                            return us.id == user.id
                        })

                        this.$set(curr, 'online', true)
                    })

                })
                .joining((user) => {
                    var curr = _.find(this.conversation.users, (us) => {
                        return us.id == user.id
                    })
                    this.$set(curr, 'online', true)
                })
                .leaving((user) => {
                    var curr = _.find(this.conversation.users, (us) => {
                        return us.id == user.id
                    })

                    this.$set(curr, 'online', false)
                })


        },
        methods: {
            send(){

                if(this.message){
                    axios.post('/conversations/' + this.conversation.id + '/send', {
                        message: this.message
                    })
                    .then(response => {
                        this.message = ''
                    })
                    .catch(error => {
                        console.log(error)
                    })
                    this.message = ''
                }

            },
            sendFile(){
                var formData = new FormData();
                formData.append("upl", this.fileCont)

                axios.post('/conversations/' + this.conversation.id + '/sendfile', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                })
                .then(response => {
                    console.log(response.data)
                    this.fileCont = null
                })
                .catch(error => {
                    console.log(error)
                })
                this.message = ''
                $('#file-input').val('')
            },

            removeFile() {
                $('#file-input').val('')
                this.fileCont = null
            },

            addUser(){
                $('#add-user').modal('show')
            },
            changeTitle(){
                $('#change-title').modal('show')
            },
            processFile(event) {
                this.fileCont = event.target.files[0]
            },
            scrollToBottom(){
                var target = $('.messages-cont')
                target.animate({scrollTop:  target[0].scrollHeight}, 100);
            },
            loadMessages(){
                this.loading = true
                axios.get('/conversations/' + this.conversation.id + '/messages', {
                    params: {
                        page: this.page
                    }
                })
                .then(response => {
                    this.loading = false
                    if(response.data.data.length){
                        this.page++
                    }

                    this.messages = _.concat(this.messages, response.data.data)
                    // this.scrollToBottom()
                })
                .catch(error => {
                    console.log(error)
                })
            }
        },
        computed: {
            messagesSorted() {
                return _.orderBy(this.messages, ['created_at'], ['asc'])
            },
            title(){
                if(this.conversation.data.title) {
                    return this.conversation.data.title
                }else{
                    return _.join(_.map(this.conversation.users.slice(0, 3), 'name'), ', ')
                                        + (this.conversation.users.length > 3 ? ', +' + (this.conversation.users.length - 3) + ' more users': '')
                }
            },

        }

    }
</script>


<style lang="scss" scoped>
    .card {
        height: 450px !important;
    }

    ul {
        list-style: none;
        padding-left: 0px;
        margin-bottom: 0px;
    }

    .user-cont {
        ul {
            margin-top: 16px;
        }
    }

    .messages-cont{
        ul {
            position: relative;

            .typing {
                position: absolute;
                bottom: 10px;
                left: 50%;
                transform: translate(-50%);
            }
        }



        &::-webkit-scrollbar {
            width: 4px;
        }

        /* Track */
        &::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        &::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        &::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    }


    .option {
        float: right;
        color: #999;
        font-size: 22px;

        &:hover {
            color: #555;
        }
    }

    // .typing {
    //     padding: 5px 16px;
    //     border-radius: 10px;
    // }

    .fa-spinner {
        font-size: 40px;
        color: #ccc;
    }

</style>
