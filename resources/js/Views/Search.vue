<template>
<main class="py-1">

    <div class="container">
      <div class="row row-cols-1">
          <div class="col research">
            <div class="col-12 col-md-8 offset-md-2">
                <form @submit.prevent = "setmap()" class="input_search row py-3" action="/search">
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
              <a class="mod_btn btn_pink_border mb-3 inline_block" data-bs-toggle="collapse" href="#filtersCollapse" role="button" aria-expanded="false" aria-controls="filtersCollapse">Mostra filtri</a>

              <div class="collapse multi-collapse my-5" id="filtersCollapse">
                <form @submit.prevent="setFilters()" ref="filterform">
                  <div class="form-group">
                      <label for="address">Raggio: </label>
                      <input type="range" min="20" max="200" v-model = "mpd" class="form-control-range" id="address" placeholder="Inserisci un indirizzo" ref="mpdRange">
                      {{ mpd }}
                  </div>
                  <div class="form-group">
                      <label for="max_price">Prezzo massimo</label>
                      <input type="number" class="form-control form_textbox" id="max_price" ref="max_price" placeholder="Inserisci un prezzo massimo in €" v-model="maxPrice">
                  </div>
                  <!-- <div class="form-group">
                      <label for="address">Servizi</label>
                      <input type="text" class="form-control form_textbox" id="address" ref="address" placeholder="Inserisci un indirizzo" v-model="services">
                  </div> -->
                  <div class="form-group">
                      <label for="mq">Metri quadri</label>
                      <input type="number" class="form-control form_textbox" id="mq" ref="mq" placeholder="Inserisci un indirizzo" v-model = "meters">
                  </div>
                  <div class="form-group">
                      <label for="beds">Posti letto</label>
                      <input type="number" class="form-control form_textbox" id="beds" ref="beds" placeholder="Inserisci un indirizzo" v-model="beds">
                  </div>
                  <div class="form-group">
                      <label for="checkIn">Check-in</label>
                      <input type="date" class="form-control form_textbox" id="checkIn" ref="checkIn" placeholder="Inserisci un indirizzo" v-model="checkIn">
                  </div>
                  <div class="form-group ">
                      <!-- <button v-for="service"></button> -->
                    <a class="mod_btn btn_grey_border inline_block mb-3 me-3" data-bs-toggle="collapse" href="#servicesCollapse" role="button" aria-expanded="false" aria-controls="servicesCollapse">Mostra servizi</a>
                    <a class="mod_btn btn_pink inline_block mb-3" @click.prevent="setFilters()">Filtra</a>
                    <div class="collapse multi-collapse" id="servicesCollapse">
                        <div class="row">
                            <div v-for="service in selServices" :key="service.id" class="col-auto p-3">
                            <div class="h-100">

                                <label :for="'service' + service.id">{{ service.name }}</label>
                                <input type="checkbox" class="form-check-input" :id="'sevice' + service.id" @click="handleServices(service.id)">
                            </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
          </div>
          <div class="col order-2">
              <ul class="w-100 text-center list-unstyled results-list">
                  <li v-for="result in nearBy" :key="result.id" class="mb-3"><a :href="`/houses/${result.id}`">{{result.Address}}</a></li>
              </ul>
          </div>
          <div class="col order-0">
              <div id="map" ref="map"></div>
          </div>
      </div>
    </div>
</main>
</template>

<script>
import axios from 'axios';
import tt from '@tomtom-international/web-sdk-maps';
import '@tomtom-international/web-sdk-maps/dist/maps.css';
export default {
    data() {
        return {
            mpd: 20,
            nearBy: [],
            map: null,
            maxPrice: null,
            beds: null,
            services: [],
            checkIn: null,
            meters: null,
            selServices: [],
            centerLat: null,
            centerLng: null
        }
    },
    methods: {
        initializeSearch() {
            const urlParams = new URLSearchParams(window.location.search);
            this.centerLat = urlParams.get('Lat');
            this.centerLng = urlParams.get('Lng');

            this.map = tt.map({
            key: 'Oy5FeMobhbOv0274dEpqyZNDta4FXJyA',
            container: 'map',
            center: {
                lat: this.centerLat,
                lng: this.centerLng},
            zoom: 12,
            });

            this.updateMarkers();
        },
        setmap() {
            this.centerLat = this.$refs.latinput.value;
            this.centerLng = this.$refs.lnginput.value;
            this.map = tt.map({
        key: 'Oy5FeMobhbOv0274dEpqyZNDta4FXJyA',
        container: 'map',
        center: {
            lat: this.centerLat,
            lng: this.centerLng},
        zoom: 12,
        });

        this.updateMarkers();
        },
        tomSearch() {
            const addressInput = this.$refs.address;
            const address = addressInput.value;
            const container = this.$refs.container;
            const latinput = this.$refs.latinput;
            const lnginput = this.$refs.lnginput;
            const btnResearch = document.getElementById('btn_research');
            axios.get (`https://api.tomtom.com/search/2/search/${address}.json?key=Oy5FeMobhbOv0274dEpqyZNDta4FXJyA&typeahead=true&limit=5&ofs={ofs}&countrySet=IT`).then(response => {

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
                            btnResearch.classList.remove('none');
                            btnResearch.disabled = false;
                            container.removeChild(list);
                        })
                        list.appendChild(ele);
                    })
                    container.appendChild(list);
                }
            });
        },
        handleServices(service) {
            if(this.services.includes(service)) {
                this.services.splice(this.services.indexOf(service), 1)
            } else {
                this.services.push(service)
            }

            this.setFilters();
        },
        setFilters() {
            this.mpd = this.$refs.mpdRange.value;
            this.updateMarkers();
        },
        updateMarkers() {
            const myParams = {
                centerLng: this.centerLng,
                centerLat: this.centerLat,
            }
            if (this.maxPrice) myParams['max_price'] = this.maxPrice * 100;
            if (this.services.length) myParams['services'] = this.services
            if (this.checkIn) myParams['check_in'] = this.checkIn
            if (this.beds) myParams['beds'] = this.beds
            if (this.meters) myParams['mq'] = this.meters

            Axios.get(`/api/houses/search`,{params: myParams})
            .then(res => {
                const center = {
                    lng: this.centerLng,
                    lat: this.centerLat
                }
                this.nearBy = [];
                this.$refs.map.querySelectorAll('[data-ref]').forEach(ele => {
                            ele.remove()
                        })

                console.log(res.data.services)
                this.selServices = res.data.services;
                res.data.houses.forEach((result, index) => {
                    const pos = {lng: result.Lng, lat: result.Lat};
                    if(tt.LngLat.convert(pos).distanceTo(tt.LngLat.convert(center)) / 1000 < this.mpd) {
                        console.log(result)
                        this.nearBy.push(result);
                        const ele = document.createElement('img');
                        ele.width="70";
                        const link = document.createElement('a');
                        link.href="/houses/" + result.id;
                        ele.src = this.setImage(result.Poster);
                        ele.setAttribute('data-ref', `mark${index}`);
                        link.appendChild(ele);
                        const mark = new tt.Marker(link)
                        .setLngLat(pos)
                        .addTo(this.map);
                        }
                })
            });
        },
        setImage(string) {
            const image = string.startsWith('http') ? string : `/storage/${string}`;
            return image
        }
    },
    mounted() {
        this.initializeSearch();
    },
}
</script>

<style scoped lang="scss">
.container{
    height: 100vh;
}
 #map {
    height: 100%;
    max-height: 900px;
    min-height: 30rem;
 }
 .form-group {
    margin-bottom: 1rem;
 }
 .results-list {
    padding: .5rem 0;
    li {
        padding: .5rem 0;
        background-color: #FF385C;
        border-radius: 3rem;
        cursor: pointer;
        &:hover {
            background-color: rgb(159, 42, 42);
        }
        a {
            color: white;
        }
    }
 }

 .inline_block {
    display: inline-block;
 }
</style>
