require('./bootstrap');
window.Vue = require('vue');

Vue.component('loading', require('./components/General/Loading'))



if(chatStore.token) {
    // router.push('/loading')

    if(chatStore.user) {
        var user = chatStore.user
        if(user && store.state.user !== user) {
            store.commit('setUser', user)
        }
    }

    chatService.getUser()
        .then(response => {
            if(response.data.success) {
                chatStore.user = response.data.user
                store.commit('setUser', response.data.user)
                // router.back()
            }
        })
        .catch(error => {
            console.log(error)
        })

    // chatService.refreshToken()
    //     .then(response => {
    //         chatStore.token = response.data.access_token
    //
    //         Echo.connector.options.auth.headers['Authorization'] = `Bearer ${chatStore.token}`
    //
    //         chatService.getUser()
    //             .then(response => {
    //                 if(response.data.success) {
    //                     chatStore.user = response.data.user
    //                     store.commit('setUser', response.data.user)
    //                     router.back()
    //                 }
    //             })
    //             .catch(error => {
    //                 console.log(error)
    //             })
    //
    //     })
    //     .catch(error => {
    //         chatStore.clear()
    //         $(location).attr('href', '/login')
    //     })

}


import router from './router'
import store from './store'
import App from './components/App.vue'

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.loading)) {
        next(from.path)
        console.log(to)
        console.log(from)
    } else if(to.matched.some(record => record.meta.requiresAuth)) {
        if (!chatStore.isLogged()) {
            next('/login')
        } else {
            next()
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        if (!chatStore.isLogged()){
            next()
        }
        else{
            next('/')
        }
    } else {
        next()
    }
})


const app = new Vue({
    store: store,
    render: h => h(App),
    router,
}).$mount('#app');


//
// function startEcho() {
//
// }
