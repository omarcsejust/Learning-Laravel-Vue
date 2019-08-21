/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'

/**
 * vue progress bar
 */
import VueProgressBar from 'vue-progressbar'
const VueProgressBarOptions = {
    color: '#50d38a',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, VueProgressBarOptions)

/**
 * vue Snotify
 * https://artemsky.github.io/vue-snotify/documentation/installation.html
 */
import Snotify, { SnotifyPosition } from 'vue-snotify'
const SnotifyOption = {
    toast: {
        position: SnotifyPosition.rightTop
    }
}
Vue.use(Snotify, SnotifyOption)

/**
 * vform
 * register component globally at the below
 * https://github.com/cretueusebiu/vform
 */
import { Form, HasError, AlertError } from 'vform'
window.Form = Form

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('category-component', require('./components/CategoryComponent.vue').default);

Vue.component('customer-data-component', require('./components/customer/CustomerDataComponent.vue').default);
Vue.component('add-customer-component', require('./components/customer/AddCustomerComponent.vue').default);

//Vue.component('pagination-component', require('./components/partial/PaginationComponent.vue').default);

/**
 * vue pagination component register
 * https://github.com/gilbitron/laravel-vue-pagination
 */
Vue.component('pagination', require('laravel-vue-pagination'));

/**
 * vue vform registering globally here
 */
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
