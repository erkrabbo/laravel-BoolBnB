/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Axios = require('axios');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import App from './Views/App.vue';
import Vuex from 'vuex'

const store = new Vuex.Store({
    state: {
        sponsored: [],
        last: [],
        lastsPage: 1,
        sponsoredPage: 1,
    },
    mutations: {
        retrieveSponsored(state, page) {
            Axios.get(`api/houses/sponsored?page=${page}`)
        .then(response => {
            state.sponsored = response.data.sponsoredHouses.data;
            // console.log(state.sponsored);
        })
        },
        retrieveLasts(state, page) {
            Axios.get(`api/houses/last?page=${page}`)
        .then(response => {
            state.last = response.data.houses.data;
            // console.log(response)
        })
        },
        incrementLastsPage(state) {
            state.lastsPage++;
            this.commit('retrieveLasts', state.lastsPage);
        }
    }
});

const app = new Vue({
    el: '#app',
    store,
    render: h => h(App)
})
