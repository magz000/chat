<template>
    <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">User</label>

                        <div class="col-md-6">
                            <select class="form-control" v-model="user">
                                <option v-for="usr in usersLimited" :value="usr">{{ usr.name }}</option>

                            </select>
                            <!-- <input class="form-control" v-model="title"> -->
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
    export default {
        props: ['conversation'],
        data(){
            return {
                users: [],
                user: null,
            }
        },
        mounted() {
            axios.get('/users')
            .then(response => {
                this.users = response.data.users
            })
            .catch(error => {
                console.log(error)
            })
        },
        methods: {
            submit() {
                axios.post('/conversations/' + this.conversation.id + '/adduser', {
                    user: this.user.id
                })
                .then(response => {
                    console.log(response.data)
                    _.each(response.data.users, (user) => {
                        if(!_.includes(_.map(this.conversation.users, 'id'), user.id)) {
                            this.conversation.users.push(user)
                        }
                    })
                    // this.conversation.users = response.data.users
                    $('#add-user').modal('hide')
                })
                .catch(error => {
                    console.log(error)
                })
            }
        },
        computed: {
            usersLimited() {
                return _.filter(this.users, (user) => {
                    return !_.includes(_.map(this.conversation.users, 'id'), user.id)
                })
            }
        }
    }
</script>
