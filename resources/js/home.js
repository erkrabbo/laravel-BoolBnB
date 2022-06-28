window.Vue = require('vue');
// import Vue from 'vue';
import App from './Views/App.vue';
import Vuex from 'vuex'
import Axios from 'axios';
import VueObserveVisibility from 'vue-observe-visibility'

Vue.use(VueObserveVisibility)

const store = new Vuex.Store({
    state: {
        sponsored: [],
        last: [],
        lastsPage: 1,
        lastsFinalPage: 1,
        sponsoredPage: 1,
        sponsoredFinalPage: 1,
    },
    mutations: {
        retrieveSponsored(state, page) {
            Axios.get(`api/houses/sponsored?page=${page}`)
            .then(response => {
            state.sponsored.push(...response.data.sponsoredHouses.data);
            state.sponsoredFinalPage = response.data.sponsoredHouses.last_page;
        })
        },
        retrieveLasts(state, page) {
            Axios.get(`api/houses/last?page=${page}`)
            .then(response => {
            state.last.push(...response.data.houses.data);
            state.lastsFinalPage = response.data.houses.last_page;
            // console.log(response)
        })
        },
        incrementLastsPage(state) {
            state.lastsPage++;
            this.commit('retrieveLasts', state.lastsPage);
        },
        incrementSponsoredPage(state) {
            state.sponsoredPage++;
            this.commit('retrieveSponsored', state.sponsoredPage);
        }
    }
});

const app = new Vue({
    el: '#app',
    store,
    render: h => h(App)
})
