import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Login from './components/General/Login'
import NotFound from './components/NotFound'
import Loading from './components/General/LoadingPage'

import Main from './components/Chat/Main'

let routes = [
    {
        path: '/login',
        component: Login,
        meta: { guest: true },
    },
    {
        path: '/',
        component: Main,
        meta: { requiresAuth: true },
    },
    {
        path: '/:type/:id',
        component: Main,
        meta: { requiresAuth: true },
    },
    {
        path: '/loading',
        component: Loading,
        meta: { requiresAuth: true },
    },
    // {
    //     path: '/user/:id',
    //     component: Main,
    //     meta: { requiresAuth: true },
    // },
    {
        path: '*',
        component: NotFound
    }

];


export default new VueRouter({
    mode: 'history',
    routes
});
