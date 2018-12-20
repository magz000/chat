<template>
    <li>
        <a :href="'/conversations/' + conversation.id">
        <div class="card">
            <div class="card-body">
                <h5><b>{{ title.toUpperCase() }} <span v-if="conversation.unread > 0">({{ conversation.unread }})</span> <br></b></h5>
                <b class="name" v-if="conversation.last_message">{{ conversation.last_message.sender.name }}</b>
                <p v-if="conversation.last_message && conversation.last_message.type == 'text'">{{conversation.last_message.body}}</p>
                <img v-if="conversation.last_message && conversation.last_message.type == 'image' " :src="'/storage/' + getObject.path">

                <a class="file" v-if="conversation.last_message && conversation.last_message.type == 'file'" :href="'/storage/' + getObject.path" target="_blank" :download="getObject.filename">{{ getObject.filename }}</a>
            </div>
        </div>
        </a>
    </li>
</template>

<script>
    export default {
        props: ['conversation'],
        mounted() {
            Echo.private('conversation.' + this.conversation.id)
                .listen('SendMessage', (e) => {
                    console.log(e.message)
                    this.conversation.last_message = e.message
                    this.conversation.unread++

                    this.conversation.updated_at = moment().format('YYYY-MM-DD HH:mm:ss')
                    console.log(this.conversation.updated_at)
                    // this.scrollToBottom()
                })
        },
        computed: {
            title(){
                if(this.conversation.data.title) {
                    return this.conversation.data.title
                }else{
                    return _.join(_.map(this.conversation.users.slice(0, 3), 'name'), ', ')
                                        + (this.conversation.users.length > 3 ? ', +' + (this.conversation.users.length - 3) + ' more users': '')
                }
            },

            formatLastMessage() {
                if(this.conversation.last_message){
                    return this.conversation.last_message.sender.first_name +': '+ this.conversation.last_message.body
                }
            },

            getObject(){
                if(this.conversation.last_message && this.conversation.last_message.type != 'text'){
                    var obj = JSON.parse(this.conversation.last_message.body)

                    return obj
                }
            },
        }
    }
</script>

<style lang="scss" scoped>
.class-message {
    color: #aaa;
}

li{
    padding: 10px 20px;

    a {
        text-decoration: none;
    }
}

img {
    display: block;
    height: 70px;
    margin-bottom: 16px;
}

.name, p {
    color: #aaa;
}

.file {
    display: block;
    margin-bottom: 16px;
}

.time {
    float: right;
    font-size: 10px;
}

</style>
