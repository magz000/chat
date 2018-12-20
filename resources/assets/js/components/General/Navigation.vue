<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <!-- <div class="container"> -->
        <router-link class="navbar-brand" to="/">
             Chat
        </router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item" v-if="!getUser">
                    <router-link class="nav-link" to="/login">Login</router-link>
                </li>


                <li class="nav-item dropdown" v-if="getUser">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ formatName }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" @click="logout">Logout</a>
                    </div>
                </li>

            </ul>
        </div>
        <!-- </div> -->
    </nav>
</template>

<script>
export default {
    mounted() {

    },
    methods: {
        logout(){
            // chatStore.clear()
            this.$router.push('/login')
            this.$store.commit('setUser', null)
        }
    },
    computed: {
        getUser() {
            return this.$store.getters.user
        },
        formatName() {
            return this.getUser.first_name +' '+ this.getUser.last_name
        }
    }
}
</script>

<style lang="scss" scoped>
.navbar {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 999;
    right: 0;
}
</style>
