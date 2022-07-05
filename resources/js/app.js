require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import HomeSpa from './components/HomeSpa.vue';
import CreateSpa from './components/CreateSpa.vue';
import IndexSpa from './components/IndexSpa.vue';
import EditSpa from './components/EditSpa.vue';

const routes = [
    {
        name: 'home',
        path: '/',
        component: HomeSpa
    },
    {
        name: 'stocks',
        path: '/stocks',
        component: IndexSpa
    },
    {
        name: 'create',
        path: '/create',
        component: CreateSpa
    },

    {
        name: 'edit',
        path: '/edit/:id',
        component: EditSpa
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');
