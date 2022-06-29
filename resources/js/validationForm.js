const formDelete = document.querySelector('#formDelete')
const baseAction = window.location.origin + '/admin/houses-image/*****'

const deleteButtons = document.querySelectorAll('[data-image]')
.forEach(ele => {
    ele.addEventListener('click', function() {
        formDelete.action = baseAction
        formDelete.action = formDelete.action.replace('*****', ele.dataset.image)
    }) 
})

const main = document.querySelector('.validationMain')
const form = document.getElementById('form')
const errorTitle = document.getElementById('errorTitle')
const errorContent = document.getElementById('errorContent')
const errorNofRooms = document.getElementById('errorNofRooms')
const errorNofBeds = document.getElementById('errorNofBeds')
const errorNofBaths = document.getElementById('errorNofBaths')
const errorMq = document.getElementById('errorMq')
const errorNightPrice = document.getElementById('errorNightPrice')
const errorAvailableFrom = document.getElementById('errorAvailableFrom')
const errorAvailableTo = document.getElementById('errorAvailableTo')
const title = document.getElementById('Title')
const content = document.getElementById('Content')
const n_rooms = document.getElementById('N_of_rooms')
const n_beds = document.getElementById('N_of_beds')
const n_baths = document.getElementById('N_of_baths')
const mq = document.getElementById('Mq')
const n_price = document.getElementById('Night_price')

let available_from = document.getElementById('Available_from')
let available_to = document.getElementById('Available_to')

let today = new Date();
let y = today.getFullYear();
let d = String(today.getDay()).padStart(2, '0')
let m = String(today.getMonth()+1).padStart(2, '0')
let todayDate = `${y}-${m}-${d}`

// console.log(todayDate)
// console.log(available_from.value)
// console.log(available_to.value)

form.addEventListener('submit', (e) => {
  e.preventDefault()
  let errorScroll = null
  if (!title.value) {
    errorTitle.innerHTML = 'Il titolo è obbligatorio'
    errorTitle.classList.add('balloon')
    errorScroll = errorTitle.offsetTop - 140
  } else if (!content.value) {
    errorContent.innerHTML = 'La descrizione è obbligatoria'
    errorContent.classList.add('balloon')
    errorScroll = errorContent.offsetTop - 140
  } else if (n_rooms.value < 0| !n_rooms.value) {
    errorNofRooms.innerHTML = 'Il numero delle stanze è obbligatorio e non può essere un valore negativo'
    errorNofRooms.classList.add('balloon')
    errorScroll = errorNofRooms.offsetTop - 140
  } else if (n_beds.value < 0| !n_beds.value) {
    errorNofBeds.innerHTML = 'Il numero dei letti è obbligatorio e non può essere un valore negativo'
    errorNofBeds.classList.add('balloon')
    errorScroll = errorNofBeds.offsetTop - 140

  } else if (n_baths.value < 0| !n_baths.value) {
    errorNofBaths.innerHTML = 'Il numero dei bagni è obbligatorio e non può essere un valore negativo'
    errorNofBaths.classList.add('balloon')
    errorScroll = errorNofBaths.offsetTop - 140

  } else if (mq.value < 0| !mq.value) {
    errorMq.innerHTML = 'Il numero dei metri quadri è obbligatorio e non può essere un valore negativo'
    errorMq.classList.add('balloon')
    errorScroll = errorMq.offsetTop - 140

  } else if (n_price.value < 0| !n_price.value) {
    errorNightPrice.innerHTML = 'Il prezzo è obbligatorio e non può essere un valore negativo'
    errorNightPrice.classList.add('balloon')
    errorScroll = errorNightPrice.offsetTop - 140

  } else if (available_from.value < todayDate) {
    errorAvailableFrom.innerHTML = 'La data di disponibilità è obbligatoria e non può essere precedente alla data odierna'
    errorAvailableFrom.classList.add('balloon')
    errorScroll = errorAvailableFrom.offsetTop - 140

  } else if (available_to.value < available_from.value) {
    errorAvailableTo.innerHTML = 'La data di fine disponibilità è obbligatoria e non può essere precedente alla data di inizio disponibilità'
    errorAvailableTo.classList.add('balloon')
    errorScroll = errorAvailableTo.offsetTop - 140
  } 


  if (errorScroll !== null) {
    main.scroll({
      top: errorScroll, 
      left: 0, 
      behavior: 'smooth' 
    });
  } else {
    form.submit()
  }

  // if (messages.length > 0) {
  //   errorElement.innerText = messages.join('  /  ')
  // } else {
  //   form.submit()
  // }
})
