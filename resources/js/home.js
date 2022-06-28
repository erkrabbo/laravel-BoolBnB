window.Vue = require('vue');
// import Vue from 'vue';
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
