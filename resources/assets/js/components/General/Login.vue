<template>
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" @submit.prevent="submit">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Email Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control"  v-model="user.email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="user.password" required>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" :disabled="loading">
                                        Login
                                    </button>

                                    <loading v-if="loading"></loading>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    email: null,
                    password: null,
                },
                loading: false,
            }
        },
        mounted() {

        },
        methods: {
            submit() {
                this.loading = true

                chatService.login(this.user)
                    .then(response => {
                        this.loading = false
                        chatStore.token = response.data.access_token
                        chatStore.user = response.data.user
                        this.$store.commit('setUser', chatStore.user)

                        this.$router.push('/')
                        // $(location).attr('href', '/')

                    })
                    .catch(error => {
                        this.loading = false
                        if(error.response.data)
                            alertify.error(error.response.data.error);
                    })
            }
        }
    }
</script>

<style scoped>


</style>
