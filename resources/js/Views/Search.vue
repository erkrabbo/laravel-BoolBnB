<template>
<main>

    <div class="container">
      <div class="row row-cols-1 row-cols-lg-2 h-100">
          <div class="col h-100">
              <form class="row" @submit.prevent="setmap()">
                            <label class="col-12" for="search"><h4>Ricerca</h4></label>
                            <div class="row">
                                <div class="col form-group mb-2 w-100" ref ="container">
                                    <input type="text" class="form-control form_textbox" id="search" name="search" placeholder="Cerca" ref = "address" @keyup = "tomSearch">
                                    <input type="hidden" name="Lat" ref = "latinput">
                                    <input type="hidden" name="Lng" ref = "lnginput">
                                    <input type="hidden" name="mpd" value = "20">
                                </div>
                                <button type="submit" class="col-2 mod_btn btn_pink mb-2">Cerca</button>
                            </div>
                    </form>
              <div class="form-group">
                  <label for="address">Raggio: </label>
                  <input type="range" min="20" max="200" :value = "mpd" class="form-control-range" id="address" placeholder="Inserisci un indirizzo" @change ="setFilters()" ref="mpdRange">
                  {{ mpd }}
              </div>
              <div class="form-group">
                  <label for="max_price">Prezzo massimo</label>
                  <input type="number" class="form-control" id="max_price" ref="max_price" placeholder="Inserisci un prezzo massimo in €" v-model="maxPrice" @change="setFilters()">
              </div>
              <!-- <div class="form-group">
                  <label for="address">Servizi</label>
                  <input type="text" class="form-control" id="address" ref="address" placeholder="Inserisci un indirizzo" v-model="services" @change="setFilters()">
              </div> -->
              <div class="form-group">
                  <label for="mq">Metri quadri</label>
                  <input type="number" class="form-control" id="mq" ref="mq" placeholder="Inserisci un indirizzo" v-model = "meters" @change="setFilters()">
              </div>
              <div class="form-group">
                  <label for="beds">Posti letto</label>
                  <input type="number" class="form-control" id="beds" ref="beds" placeholder="Inserisci un indirizzo" v-model="beds" @change="setFilters()">
              </div>
              <div class="form-group">
                  <label for="checkIn">Check-in</label>
                  <input type="date" class="form-control" id="checkIn" ref="checkIn" placeholder="Inserisci un indirizzo" v-model="checkIn" @change="setFilters()">
              </div>
              <div class="form-group">
                  <!-- <button v-for="service"></button> -->
                  <div v-for="service in selServices" :key="service.id">

                      <label :for="'service' + service.id">{{ service.name }}</label>
                      <input type="checkbox" class="form-check-input" :id="'sevice' + service.id" @click="handleServices(service.id)">
                  </div>
              </div>
              <!-- <button @click="incrementMpd()">mpd</button> -->
          </div>
          <div class="col">
              <div id="map" ref="map"></div>
          </div>
      </div>
    </div>
</main>
</template>

<script>
import axios from 'axios';
import tt from '@tomtom-international/web-sdk-maps';
// import { services } from '@tomtom-international/web-sdk-services';
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
    // computed: {
    //     centerLat() {
    //         const urlParams = new URLSearchParams(window.location.search);
    //         return urlParams.get('Lat');
    //     },
    //     centerLng() {
    //         const urlParams = new URLSearchParams(window.location.search);
    //         return urlParams.get('Lng');
    //     }
    // },
    methods: {
        // setMpd() {
        //     console.log(this.$refs.mpdRange.value)
        //     this.mpd = this.$refs.mpdRange.value;
        //     this.updateMarkers();
        // },
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
                            console.log(item.position.lat)
                            console.log(item.position.lon)
                            addressInput.value = ele.innerHTML;
                            latinput.value = item.position.lat;
                            lnginput.value = item.position.lon;
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
                        ele.src = this.setImage(result.Poster);
                        ele.setAttribute('data-ref', `mark${index}`);
                        const mark = new tt.Marker(ele)
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

        // const map = tt.map({
        // key: 'Oy5FeMobhbOv0274dEpqyZNDta4FXJyA',
        // container: 'map',
        // center: {
        //     lat: this.centerLat,
        //     lng: this.centerLng},
        // zoom: 15,
        // });
    },
}
</script>

<style scoped lang="scss">
.container{
    height: 100vh;
}
 #map {
    height: 100%;
    min-height: 30rem;
 }
</style>
