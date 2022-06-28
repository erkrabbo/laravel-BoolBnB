<template>
<main class="">
    <section class="research">
        <div class="container">
            <div class="row">
                <!-- <div class="col-8 offset-2"> -->
                <div class="col-12 col-md-8 offset-md-2">
                    <form class="input_search row py-3" action="/search">
                        <div class="row">
                            <div class="relative_ul col form-group mb-2 w-100" ref ="container">
                                <input type="text" class="form-control form_textbox px-4" autocomplete="off" id="search" name="search" placeholder="Ricerca una località" ref = "address" @keyup = "tomSearch">
                                <input type="hidden" name="Lat" ref = "latinput">
                                <input type="hidden" name="Lng" ref = "lnginput">
                                <input type="hidden" name="mpd" value = "20">
                            </div>
                            <button disabled id="btn_research" type="submit" class="none col-2 mod_btn btn_pink mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="sponsored" v-if="sponsored.length">
        <div class="container pt-3">
            <h1>In primo piano</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3 mb-3">
                <house-card v-for="house in sponsored" :key="house.id" :house="house"></house-card>
                <div v-if="sponsored.length" v-observe-visibility="sponsoredHousesLoad"></div>

            </div>
        </div>
    </section>
    <section class="recent" v-if="last.length">
        <div class="container pt-3">
            <h1>Recenti</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                <house-card v-for="house in last" :key="house.id" :house="house"></house-card>
                <div v-if="last.length" v-observe-visibility="lastHousesLoad"></div>
            </div>
        </div>
    </section>
</main>
</template>

<script>
// import Axios from 'axios'
import axios from 'axios';
import HouseCard from '../components/HouseCard.vue'

export default {
    name: 'App',
    components: {
        HouseCard
    },
    methods: {
        sponsoredHousesLoad(isVisible) {
            if (!isVisible) {
                return;
            }
            // console.log('ciao')
            // console.log(this.sponsored)
            if (this.sponsoredPage <= this.sponsoredFinalPage) {
                this.$store.commit('incrementSponsoredPage');
            }
        },
        lastHousesLoad(isVisible) {
            if (!isVisible) {
                return;
            }
            // console.log('ciao')
            // console.log(this.sponsored)
            if (this.lastsPage <= this.lastsFinalPage) {
                this.$store.commit('incrementLastsPage');
            }
        },
        tomSearch() {
            const addressInput = this.$refs.address;
            const address = addressInput.value;
            const container = this.$refs.container;
            const latinput = this.$refs.latinput;
            const lnginput = this.$refs.lnginput;
            const btnResearch = document.getElementById('btn_research');
            axios.get (`https://api.tomtom.com/search/2/search/${address}.json?key=Oy5FeMobhbOv0274dEpqyZNDta4FXJyA&typeahead=true&limit=5&ofs={ofs}&countrySet=IT`).then(response => {
                // console.log(response)
                // console.log(response.data.results[0].position.lat)
                // console.log(response.data.results[0].position.lon)

                if(response.data.results.length > 0) {
                    const data = response.data.results;
                    if(container.querySelector('ul')) {
                        container.querySelector('ul').remove();
                    }
                    const list = document.createElement('ul');
                    data.forEach(item => {
                        console.log(item)
                        const ele = document.createElement('li');
                        const street = item.address.streetNumber ? item.address.streetName + ' ' + item.address.streetNumber : item.address.streetName;
                        if(street) {
                            ele.innerHTML = `${street} ${item.address.municipality && item.address.municipality} ${item.address.country && item.address.country}`;
                        }else{
                            ele.innerHTML = `${item.address.municipality && item.address.municipality} ${item.address.country && item.address.country}`;
                        }
                        ele.addEventListener('click', () => {
                            btnResearch.classList.toggle('none')
                            console.log(item.position.lat)
                            console.log(item.position.lon)
                            addressInput.value = ele.innerHTML;
                            latinput.value = item.position.lat;
                            lnginput.value = item.position.lon;
                            // btnResearch.style='display: block';
                            btnResearch.classList.remove('none');
                            btnResearch.disabled = false;
                            container.removeChild(list);
                        })
                        list.appendChild(ele);
                    })
                    container.appendChild(list);
                }
            });
        }
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
        },
        sponsoredFinalPage() {
            return this.$store.state.sponsoredFinalPage;
        },
        lastsFinalPage() {
            return this.$store.state.lastsFinalPage;
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
