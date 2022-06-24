/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Axios = require('axios');

// console.log(dropin)

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
import Axios from 'axios';

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

const dropin = require('braintree-web-drop-in');
const button = document.querySelector('#submit-button');
const hiddenNonceInput = document.querySelector('#prova')
const form = document.querySelector('#form')


dropin.create({
    authorization: 'sandbox_gp967cyr_6gbmtt3qhmmnktb8',
    container: '#dropin-container'
    }, function (createErr, instance) {

    button.addEventListener('click', function (e) {

    e.preventDefault()

    instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {

        hiddenNonceInput.value = payload.nonce;
        form.submit();

        });
    });
});
