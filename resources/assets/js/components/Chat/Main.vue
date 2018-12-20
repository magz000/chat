<template>
    <div class="row mx-0 h-100">
        <conversation-list class="col-md-3"></conversation-list>
        <message-list v-if="selectedConversation" class="col-md-9" :conversation="selectedConversation"></message-list>
        <user-list id="user-list-modal" v-if="selectedConversation" :conversation="selectedConversation"></user-list>
    </div>
</template>

<script>
import ConversationList from './Conversation/List'
import MessageList from './Message/List'
import UserList from './Users/List'
export default {
    components: {
        ConversationList, MessageList, UserList
    },
    data() {
        return {
            // onlines: [],
        }
    },
    watch: {

    },
    mounted() {
        axios.all([
            chatService.getConversations(),
            chatService.getUsers()
        ])
        .then(axios.spread((conv, users) => {
            this.listen()

            this.$store.commit('setConversations', conv.data.conversations)
            this.$store.commit('setUsers', users.data.users)

            if(this.conversations.length) {
                this.$store.commit('setSelectedConv', _.first(this.conversations))
                this.$store.commit('setSelectedConvType', 'conversation')
            } else if( this.users.length) {
                this.$store.commit('setSelectedConv', _.first(this.users))
                this.$store.commit('setSelectedConvType', 'user')
            }

        }))
        .catch(error => {
            console.log(error)
        })

        // chatService.getConversations()
        //     .then(response => {
        //         this.$store.commit('setConversations', response.data.conversations)
        //
        //         this.listen()
        //
        //         if(this.conversations.length) {
        //             this.$store.commit('setSelectedConv', _.first(this.conversations))
        //             this.$store.commit('setSelectedConvType', 'conversation')
        //         }
        //     })
        //     .catch(error => {
        //         console.log(error)
        //     })
        //
        // chatService.getUsers()
        //     .then(response => {
        //         this.$store.commit('setUsers', response.data.users)
        //
        //         if(!this.conversations.length && this.users.length) {
        //             this.$store.commit('setSelectedConv', _.first(this.users))
        //             this.$store.commit('setSelectedConvType', 'user')
        //         }
        //     })
        //     .catch(error => {
        //         console.log(error)
        //     })




    },
    methods: {
        listen() {

            Echo.join('chat-main')
                .here((users) => {
                    this.$store.commit('setOnlines', users)
                })
                .joining((user) => {
                    this.$store.commit('userJoining', user)
                })
                .leaving((user) => {
                    this.$store.commit('userLeaving', user)
                })

            Echo.private(`chat.user.${ this.user.id }`)
                .listen('ConversationCreated', (c) => {
                    this.$store.commit('addConversation', c.conversation)
                })
                .listen('MessageSent', (c) => {
                    var conv = _.find(this.conversations, (con) => {
                        return con.id == c.message.conversation_id
                    })

                    if(conv) {
                        if(conv.unread) {
                            if(!(this.selectedConversation && conv.id == this.selectedConversation.id)) {
                                conv.unread++
                            }
                            conv.updated_at = moment().format('YYYY-MM-DD HH:mm:ss')
                            conv.last_message = c.message
                        }else{
                            if(!(this.selectedConversation && conv.id == this.selectedConversation.id)) {
                                this.$set(conv, 'unread', 1)
                            }
                            conv.updated_at = moment().format('YYYY-MM-DD HH:mm:ss')
                            this.$set(conv, 'last_message', c.message)
                        }
                    }
                })
        }
    },
    computed: {
        user() {
            return this.$store.getters.user
        },
        users() {
            return this.$store.getters.users
        },
        conversations() {
            return this.$store.getters.conversations
        },
        selectedConversation() {
            return this.$store.getters.selectedConv
            // if(this.$route.params.type == 'conversation') {
            //     return _.find(this.conversations, (c) => {
            //         return c.id == this.$route.params.id
            //     })
            // }else if(this.$route.params.type == 'user') {
            //     return _.find(this.users, (u) => {
            //         return u.id == this.$route.params.id
            //     })
            // }

        }
    }
}
</script>
