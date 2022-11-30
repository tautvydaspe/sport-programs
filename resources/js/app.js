import Register from "./vue/register";

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './vue/app'
import HomePage from './vue/home-page'
import ProgramPage from './vue/program-page'
import AdminPage from './vue/admin-page'
import LoginPage from './vue/login'
import RegisterPage from './vue/register'
import Navbar from './vue/Navbar'

Vue.use(VueRouter);
const routes = [
    { path: '/programa/:id', component: ProgramPage,
        beforeEnter: (to, from, next) => {
            axios.get('api/authenticated').then(() => {
                next()
            }).catch(() => {
                return next({name: 'Login'})
            })
        }
    },
    { path: '/', component: HomePage, name: 'Home' },
    {
        path: '/admin', component: AdminPage, name: 'Admin',
        beforeEnter: (to, from, next) => {
            axios.get('api/authenticated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        }
    },
    { path: '/login', component: LoginPage, name: 'Login' },
    { path: '/register', component: RegisterPage },
];

const router = new VueRouter({
    routes,
    mode: 'history'
})

const app = new Vue({
    el: '#app',
    router,
    components: { App, ProgramPage, AdminPage, HomePage, LoginPage, RegisterPage, Navbar }
});
