import axios from "axios";

const container = document.querySelector("#js-address-container");
const addressInput = document.getElementById('js-address');
const latinput = document.getElementById('js-lat');
const lnginput = document.getElementById('js-lng');

addressInput.addEventListener('keyup',() => {
    const address = addressInput.value;
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
                    console.log(item.position.lat)
                    console.log(item.position.lon)
                    addressInput.value = ele.innerHTML;
                    latinput.value = item.position.lat;
                    lnginput.value = item.position.lon;
                    container.removeChild(list);
                })
                list.appendChild(ele);
            })
            container.appendChild(list);
        }
    });
})
