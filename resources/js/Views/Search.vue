<template>
  <div class="container">
    <div class="row row-cols-1 row-cols-lg-2 h-100">
        <div class="col col-lg-4 h-100">
            <form>
                <div class="form-group">
                    <label for="address">Raggio</label>
                    <input type="range" min="20" max="200" class="form-control-range" id="address" ref="address" placeholder="Inserisci un indirizzo">
                </div>
                <div class="form-group">
                    <label for="address">Prezzo massimo</label>
                    <input type="text" class="form-control" id="address" ref="address" placeholder="Inserisci un indirizzo">
                </div>
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
        </div>
        <div class="col col-lg-8" >
            <div id="map"></div>
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
            mpd: 200,
            nearBy: []
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
        },
    },
    created() {

    },
    mounted() {
        const map = tt.map({
        key: 'Oy5FeMobhbOv0274dEpqyZNDta4FXJyA',
        container: 'map',
        center: {
            lat: this.centerLat,
            lng: this.centerLng},
        zoom: 15,
        });
        Axios.get(`/api/houses/search?centerLng=${this.centerLng}&centerLat=${this.centerLat}&mpd=${this.mpd}`)
        .then(res => {
                this.nearBy = res.data.houses;
                const center = {
                    lng: this.centerLng,
                    lat: this.centerLat
                }
                const near = this.nearBy;
                near.forEach(result => {
                    // console.log(result)
                    const pos = {lng: result.Lng, lat: result.Lat};
                    console.log(tt.LngLat.convert(pos).distanceTo(tt.LngLat.convert(center)) / 1000)
                    if(tt.LngLat.convert(pos).distanceTo(tt.LngLat.convert(center)) / 1000 < this.mpd) {
                        // console.log('ci sono')
                        const mark = new tt.Marker()
                        .setLngLat(pos);
                        mark.addTo(map)
                        }
                })
            })

        // const map = tt.map({
        // key: 'Oy5FeMobhbOv0274dEpqyZNDta4FXJyA',
        // container: 'map',
        // center: {
        //     lat: this.centerLat,
        //     lng: this.centerLng},
        // zoom: 15,
        // });
    }
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
