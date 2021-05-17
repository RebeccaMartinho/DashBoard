require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
