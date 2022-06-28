import tt from '@tomtom-international/web-sdk-maps';
import '@tomtom-international/web-sdk-maps/dist/maps.css';

const hiding = document.querySelector(".toggle_form")
const toggleFormButton = document.querySelector("#btn_toggle")

toggleFormButton.addEventListener('click', ()=>{
    hiding.classList.toggle("open")
})

window.addEventListener('resize', () => {
    if(window.innerWidth > 576) {
        hiding.classList = 'toggle_form';
    }
})


// const mapContainer = document.querySelector("#map");

const map = tt.map({
    key: 'Oy5FeMobhbOv0274dEpqyZNDta4FXJyA',
    container: 'map',
    center: {
        lat: lat,
        lng: lng,
    },
    zoom: 12,
    });

    const pos = {lng: lng, lat: lat};
    new tt.Marker()
    .setLngLat(pos)
    .addTo(map);
