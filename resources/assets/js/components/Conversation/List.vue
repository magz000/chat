<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button class="btn btn-primary" @click="create">Create Converation</button>
                <ul>
                    <conversation v-for="conv in sortedConversation" :conversation="conv" :key="conv.id"></conversation>
                </ul>
            </div>
        </div>


        <create-conversation :conversations="conversations" :user="user"></create-conversation>

    </div>
</template>

<script>

import Conversation from './Sub/Conversation.vue'
import CreateConversation from './Sub/CreateConversation.vue'
export default {
    props: ['conversationsOrig', 'user', 'unread'],
    components: {
        'conversation': Conversation,
        'create-conversation': CreateConversation
    },
    data() {
        return {
            conversations: this.conversationsOrig,
        }
    },
    mounted() {

    },
    methods: {
        create()  {
            $('#create-conversation').modal('show')
        }
    },
    computed: {
        sortedConversation() {
            return _.orderBy(this.conversations, ['updated_at'], ['desc'])
        }
    }
}
</script>


<style lang="scss" scoped>

ul{
    padding-left: 0px;
    margin-bottom: 0px;
    list-style: none;
}

</style>
