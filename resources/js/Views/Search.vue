<template>
  <div class="container">
    <div class="row row-cols-1 row-cols-lg-2 h-100">
        <div class="col col-lg-4 h-100">
            <div class="form-group">
                <label for="address">Raggio: </label>
                <input type="range" min="20" max="200" :value = "mpd" class="form-control-range" id="address" placeholder="Inserisci un indirizzo" @change ="setFilters()" ref="mpdRange">
                {{ mpd }}
            </div>
            <div class="form-group">
                <label for="max_price">Prezzo massimo</label>
                <input type="number" class="form-control" id="max_price" ref="max_price" placeholder="Inserisci un prezzo massimo in €" v-model="maxPrice" @change="setFilters()">
            </div>
            <form>
                <div class="form-group">
                    <label for="address">Servizi</label>
                    <input type="text" class="form-control" id="address" ref="address" placeholder="Inserisci un indirizzo">
                </div>
                <div class="form-group">
                    <label for="address">Metri quadri</label>
                    <input type="text" class="form-control" id="address" ref="address" placeholder="Inserisci un indirizzo">
                </div>
                <div class="form-group">
                    <label for="address">Numero di stanze</label>
                    <input type="text" class="form-control" id="address" ref="address" placeholder="Inserisci un indirizzo">
                </div>
                <div class="form-group">
                    <label for="address">Check-in</label>
                    <input type="text" class="form-control" id="address" ref="address" placeholder="Inserisci un indirizzo">
                </div>
            </form>
            <!-- <button @click="incrementMpd()">mpd</button> -->
        </div>
        <div class="col col-lg-8">
            <div id="map" ref="map"></div>
        </div>
    </div>
  </div>
</template>

<script>
import tt from '@tomtom-international/web-sdk-maps';
// import { services } from '@tomtom-international/web-sdk-services';
import '@tomtom-international/web-sdk-maps/dist/maps.css';
export default {
    data() {
        return {
            mpd: 20,
            nearBy: [],
            map: null,
            maxPrice: null
        }
    },
    computed: {
        centerLat() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('Lat');
        },
        centerLng() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('Lng');
        }
    },
    methods: {
        // setMpd() {
        //     console.log(this.$refs.mpdRange.value)
        //     this.mpd = this.$refs.mpdRange.value;
        //     this.updateMarkers();
        // },
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

                res.data.houses.forEach((result, index) => {
                    const pos = {lng: result.Lng, lat: result.Lat};
                    if(tt.LngLat.convert(pos).distanceTo(tt.LngLat.convert(center)) / 1000 < this.mpd) {
                        this.nearBy.push(result);
                        const ele = document.createElement('img');
                        ele.src = `${result.Poster}`;
                        ele.setAttribute('data-ref', `mark${index}`);
                        const mark = new tt.Marker(ele)
                        .setLngLat(pos)
                        .addTo(this.map);
                        }
                })
            });
        }
    },
    mounted() {
        this.map = tt.map({
        key: 'Oy5FeMobhbOv0274dEpqyZNDta4FXJyA',
        container: 'map',
        center: {
            lat: this.centerLat,
            lng: this.centerLng},
        zoom: 12,
        });

        this.updateMarkers();

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
 }
</style>
