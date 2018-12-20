import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Login    from './pages/General/Login'
import NotFound from './pages/NotFound'

import Dash     from './pages/Dash'

import Main     from './pages/Dashboard/Main'

import System   from './pages/System/List'
import Group    from './pages/Group/List'
import Account  from './pages/Account/List'
import User     from './pages/User/List'


let routes = [
    {
        path: '/login',
        component: Login,
        meta: { guest: true },
    },
    {
        path: '/',
        component: Dash,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/',
                component: Main,
            },
            {
                path: '/systems',
                component: System,
            },
            {
                path: '/groups',
                component: Group,
            },
            {
                path: '/accounts',
                component: Account,
            },
            {
                path: '/users',
                component: User,
            },
        ]
    },
    {
        path: '*',
        component: NotFound
    }
];


export default new VueRouter({
    mode: 'history',
    base: '/admin',
    routes
});
