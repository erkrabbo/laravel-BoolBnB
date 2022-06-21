<template>
<main class="py-4">
    <section v-if="sponsored.length">
        <div class="container">
            <h1>In primo piano</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                <house-card v-for="house in sponsored" :key="house.id" :house="house"></house-card>
            </div>
        </div>
    </section>
    <section v-if="last.length">
        <div class="container">
            <h1>Recenti</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                <house-card v-for="house in last" :key="house.id" :house="house"></house-card>
            </div>
        </div>
    </section>
</main>
</template>

<script>
// import Axios from 'axios'
// import Axios from 'axios';
import HouseCard from '../components/HouseCard.vue'
export default {
    name: 'App',
    components: {
        HouseCard
    },
    computed: {
        sponsored() {
            return this.$store.state.sponsored;
        },
        last() {
            return this.$store.state.last;
        },
        lastsPage() {
            return this.$store.state.lastsPage;
        },
        sponsoredPage() {
            return this.$store.state.sponsoredPage;
        }
    },
    created(){

        this.$store.commit('retrieveSponsored', this.sponsoredPage)
        this.$store.commit('retrieveLasts', this.lastsPage);
        // Axios.get('/api/user/liked')
        // .then(response => {
        //     console.log(response.data)
        // })
    },
    mounted(){
        // setTimeout(() => {
        //     this.$store.commit('incrementLastsPage');
        // }, 5000);
        // const id = this.userId;
        // Axios.get('/api/user/logged', {'user': id}).then(response => {
        //     console.log(response.data)
            // if(response.data.logged){
            //     this.$store.commit('setUser', response.data.user);
            // }
        // )
    }
}
</script>

<style>
 main {
    height: 90vh;
    overflow-y: auto;
 }
</style>
