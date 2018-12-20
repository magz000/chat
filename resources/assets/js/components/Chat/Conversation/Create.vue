<template>
    <div class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Conversation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">Title</label>
                        <div class="col-md-9">
                            <input class="form-control" v-model="title">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">User</label>
                        <div class="col-md-9">
                                <multiselect v-model="user_selected" :options="usersLimited" :multiple="true" :close-on-select="false"
                                :clear-on-select="true" :hide-selected="true" :preserve-search="false" placeholder="Pick some" label="name" track-by="name" :preselect-first="true">
                                <template slot="tag" slot-scope="props"><span class="custom__tag badge badge-primary"><span>{{ props.option.first_name +' '+  props.option.last_name}}</span><span class="custom__remove" @click="props.remove(props.option)">&times;</span></span></template>
                            </multiselect>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="submit">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
    // props: ['users'],
    components: {
        Multiselect,
    },
    data(){
        return {
            // users: [],
            user_selected: null,
            title: null,
        }
    },
    mounted() {
        // axios.get('/api/users')
        // chatService.getUsers()
        //     .then(response => {
        //         this.$store.commit('setChatUsers', response.data.users)
        //     })
        //     .catch(error => {
        //         console.log(error)
        //     })
    },
    methods: {
        submit() {
            this.$store.commit('setSelectedConv', this.user_selected)
            this.$store.commit('setSelectedConvType', 'users')
            this.user_selected = null
            $(this.$el).modal('hide')
        }
        // submit() {
        //     chatService.createConversation({
        //         users: _.map(this.user_selected, 'id'),
        //         title: this.title,
        //     })
        //     .then(response => {
        //         $('#create-modal').modal('hide')
        //         this.$store.commit('addConversation', response.data.conversation)
        //     })
        //     .catch(error => {
        //         console.log(error)
        //     })
        // }
    },
    computed: {
        usersLimited() {
            if(this.user) {
                return _.filter(this.users, (user) => {
                    return user.id != this.user.id
                })
            }else {
                return []
            }

        },
        user() {
            return this.$store.getters.user
        },
        users() {
            return this.$store.getters.users
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~vue-multiselect/dist/vue-multiselect.min.css';

.custom__tag {
    // background-color: #58E3D3;
    padding: 4px 8px;
    border-radius: 10px;
    margin: 2px;
    display: inline-block;
}


.custom__remove {
    color: red;
    font-size: 12px;
    margin-left: 5px;
    font-weight: bold;

    &:hover {
        color: #AD0000;
    }
}

</style>
