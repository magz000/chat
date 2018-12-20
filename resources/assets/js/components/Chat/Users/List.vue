<template>
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Participants</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="__user-list">
                        <item v-for="(u, index) in conversationsUsers" :key="index" :user="u" ></item>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="__user-cont p-0">
        <div class="__header">
            Users
        </div>

        <div class="__user-list">
            <item v-for="(u, index) in conversationsUsers" :key="index" :user="u" ></item>
        </div>

    </div> -->
</template>

<script>
import Item from './Item'
export default {
    props: ['conversation'],
    components: {
        Item
    },
    computed: {
        user() {
            return this.$store.getters.user
        },
        conversationsUsers() {
            return _.filter(this.conversation.users, (u) => {
                return u.id != this.user.id
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.__user-cont {
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

    .__user-list {
        padding: 16px;
        flex: 1;
    }
}


</style>
