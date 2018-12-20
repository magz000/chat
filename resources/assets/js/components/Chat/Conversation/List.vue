<template>
    <div class="__conv-container p-0">
        <div class="__header">
            Conversations

            <i class="fa fa-plus" @click="add"></i>
        </div>

        <div class="__search">
            <input placeholder="Search Messages" v-model="search">
            <i class="fa fa-search left-input" aria-hidden="true"></i>
        </div>

        <div class="__conv-list">
            <!-- <center><loading class="mt-4" v-if="loading"></loading></center> -->

            <item v-for="(c, index) in sortedConversation"
                    :key="'conv' + c.id"
                    :conversation="c"
                    :search="search"></item>

            <item-user v-for="(c, index) in filterUser"
                    :key="'user' + c.id"
                    :user="c"
                    :search="search"></item-user>
        </div>

        <create ref="create" id="create-groupchat-modal"></create>
    </div>
</template>

<script>
import Create from './Create'
import Item from './Item'
import ItemUser from './ItemUser'
export default {
    // props: ['conversations'],
    components: {
        Item, Create, ItemUser
    },
    data() {
        return {
            loading: false,
            search: null,
        }
    },
    mounted() {

    },
    methods: {
        add() {
            $(this.$refs.create.$el).modal('show')
        }
    },
    computed: {
        sortedConversation() {
            return _.orderBy(this.conversations, ['updated_at'], ['desc'])
        },
        conversations() {
            return this.$store.getters.conversations
        },
        users() {
            return this.$store.getters.users
        },
        privateConv() {
            return  _.filter(this.conversations, (c) => {
                return c.private
            })

        },
        privateConvUsers() {
            return _.flatten(_.map( this.privateConv, (u) => {
                return u.users
            }))
        },
        filterUser() {
            return _.filter(this.users, (u) => {
                return !_.find(this.privateConvUsers, (p) => {
                    return u.id === p.id
                })
            })
        },

    }
}
</script>

<style lang="scss" scoped>
.__conv-container {
    background: #fff;
    height: 100%;

    display: flex;
    flex-direction: column;
    border-right: 1px solid #ccc;

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

            &:hover {
                color: #aaa;
            }
        }
    }

    .__search {
        position: relative;

        input{
            width: 100%;
            border-width: 0px 0px 1px 0px;
            font-size: 12px;
            padding-left: 30px;
            height: 28px;

        }

        .left-input {
            left: 5px;
            position:absolute;
            top:5px;
            font-size: 16px;
            color: #a6a6a6;
        }
    }

    .__conv-list {
        overflow-y: auto;
        flex: 1;

        &::-webkit-scrollbar {
            width: 3px;
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



}
</style>
