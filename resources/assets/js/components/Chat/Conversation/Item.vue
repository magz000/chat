<template>
    <!-- <router-link :to="'/conversation/' + conversation.id" v-if="isSearched"> -->
        <div class="col-12 __conv-item" :class="{active: isActive}" @click="setSelected" v-if="isSearched">

            <div class="avatar"  :style="bg"></div>

            <i class="fa fa-circle" :class="{ online: isOnline }"></i>

            <span class="name">
                {{ title }}
                <span v-if="conversation.unread > 0">
                    ({{ conversation.unread }})
                </span>
            </span>

            <br>

            <p>{{ formatLastMessage }}</p>

        </div>
    <!-- </router-link> -->
</template>

<script>
export default {
    props: ['conversation', 'search'],
    mounted() {

    },
    methods: {
        setSelected(){
            this.$store.commit('setSelectedConv', this.conversation)
            this.$store.commit('setSelectedConvType', 'conversation')
        }
    },
    computed: {
        formatLastMessage() {
            var lastMessage = this.conversation.last_message
            if(lastMessage){
                var sender = lastMessage.user_id == this.user.id ? 'You' : lastMessage.sender.name

                if(lastMessage.type == 'text') {
                    return sender + ': ' + (lastMessage.body.length < 25 ?
                                            lastMessage.body :
                                            lastMessage.body.substr(0, 25) + ' ...')
                }else if(lastMessage.type == 'image') {
                    return sender + ' sent an image.'
                }else if(lastMessage.type == 'file') {
                    return sender + ' sent an file.'
                }
            }
        },
        title(){
            if(this.conversation.data.title && !this.conversation.private) {
                return this.conversation.data.title
            }else{
                var users = _.filter(this.conversation.users, (u) => {
                    return u.id != this.user.id
                })

                return _.join(_.map(users.slice(0, 3), 'name'), ', ')
                                    + (users.length > 3 ? ', +' + (users.length - 3) + ' more users': '')
            }
        },
        user() {
            return this.$store.getters.user
        },
        onlines() {
            return this.$store.getters.onlines
        },
        conversationsUsers() {
            return _.filter(this.conversation.users, (u) => {
                return u.id != this.user.id
            })
        },
        isOnline() {
            var users = _.map(this.conversationsUsers, 'id')
            var onlines = _.map(this.onlines, 'id')
            return _.intersection(users, onlines).length
        },
        isSearched() {
            if(this.search && this.search.length) {
                return this.title.toLowerCase().includes(this.search.toLowerCase())
            } else {
                return true
            }
        },
        selected() {
            return this.$store.getters.selectedConv
        },
        type() {
            return this.$store.getters.selectedConvType
        },
        isActive() {
            if(this.selected)
            return this.conversation.id == this.selected.id && this.type == 'conversation'
        },
        image() {
            if(this.conversation.private) {
                var user = _.first(this.conversationsUsers)

                return user ? user.image.link : '/images/profile-placeholder.png'
            }else {
                return '/images/profile-placeholder.png'
            }
        },
        bg() {
            return {
                background: `url('${this.image}')` ,
                marginRight: `10px`,
            }
        },
    }
}
</script>

<style lang="scss" scoped>
.__conv-item {
    background: #fff;
    padding: 10px;
    font-size: 12px;
    border-top: 1px solid #cccccc;
    cursor: pointer;

    &:hover {
        background: #eee;
    }

    &.active {
        background: #efefef;
    }
}

a {
    text-decoration: none;
}

.name {
    color: #515151;
    font-weight: bold;
}

p {
    color: #aaa;
    margin-bottom: 0px;
}

.fa {
    color: #ccc;
    position:absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);

    &.online {
        color: #39D171;
    }
}

</style>
