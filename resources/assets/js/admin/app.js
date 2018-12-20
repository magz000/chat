require('./bootstrap');
window.Vue = require('vue');

Vue.component('loading', require('./pages/General/Loading'))

if(adminStore.token) {
    if(adminStore.user) {
        var user = adminStore.user
        if(user && store.state.user !== user) {
            store.commit('setUser', user)
        }
    }

    adminService.getUser()
        .then(response => {
            if(response.data.success) {
                adminStore.user = response.data.user
                store.commit('setUser', response.data.user)
                // router.back()
            }
        })
        .catch(error => {
            console.log(error)
        })
}


import router from './router'
import store from './store'
import App from './pages/App.vue'

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.loading)) {
        next(from.path)
        console.log(to)
        console.log(from)
    } else if(to.matched.some(record => record.meta.requiresAuth)) {
        if (!adminStore.isLogged()) {
            next('/login')
        } else {
            next()
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        if (!adminStore.isLogged()){
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
