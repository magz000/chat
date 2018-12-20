<template>
    <div class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Admin Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit" action="" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" v-model="user.username" required >
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" v-model="user.password" required >
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control"
                                v-model="user.password_confirmation" required >
                        </div>

                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" v-model="user.first_name" required >
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" v-model="user.last_name" required >
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit"
                        class="btn btn-primary"
                        :disabled="loading"
                        @click="submit">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['accounts'],
    data() {
        return {
            user: {
                username: null,
                password: null,
                password_confirmation: null,
                first_name: null,
                last_name: null,
            },
            loading: false,
        }
    },
    methods: {
        submit() {
            this.loading = true

            adminService.storeAccount(this.user)
                .then(response => {
                    this.loading = false
                    if(response.data.success) {
                        alertify.success('Successfully Added')
                        this.accounts.push(response.data.account)
                        this.name = null
                        $(this.$el).modal('hide')
                    }
                })
                .catch(error => {
                    this.loading = false
                    if (error.response && error.response.status == 422) {
                        var error = error.response.data.errors
                        for ( var key in error ) {
                            _.each(error[key], (cr) => {
                                alertify.error(cr)
                            })
                        }
                    }else{
                        console.log(error)
                        // alertify.error(error.response.data.message)
                    }
                })
        },
    }
}
</script>

<style lang="scss" scoped>

</style>
