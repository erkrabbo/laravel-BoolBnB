import Vue from 'vue'
import Search from './Views/search.vue'

const search = new Vue({
    el: '#search',
    render: h => h(Search),
});
