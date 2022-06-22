console.log('ciao')

const formDelete = document.querySelector('#formDelete')
const baseAction = window.location.origin + '/admin/houses-image/*****'

const deleteButtons = document.querySelectorAll('[data-image]')
.forEach(ele => {
    ele.addEventListener('click', function() {
        formDelete.action = baseAction
        formDelete.action = formDelete.action.replace('*****', ele.dataset.image)
    }) 
})



const form = document.getElementById('form')
const errorElement = document.getElementById('error')
const title = document.getElementById('Title')
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
  let messages = []
  if (!title.value) {
    messages.push('Il titolo è obbligatorio')
  }

  if (n_rooms.value < 0) {
    messages.push('Il numero delle stanze non può essere un valore negativo')
  }

  if (n_beds.value < 0) {
    messages.push('Il numero dei letti non può essere un valore negativo')
  }

  if (n_baths.value < 0) {
    messages.push('Il numero dei bagni non può essere un valore negativo')
  }

  if (mq.value < 0) {
    messages.push('Il numero dei metri quadri non può essere un valore negativo')
  }

  if (n_price.value < 0) {
    messages.push('Il prezzo non può essere un valore negativo')
  }

  if (available_from.value < todayDate) {
    messages.push('La disponibilità non può essere precedente alla data odierna')
  }

  if (available_to.value < available_from.value) {
    messages.push('La data di fine disponibilità non può essere precedente alla data di inizio disponibilità')
  }

  if (messages.length > 0) {
    errorElement.innerText = messages.join('  /  ')
  } else {
    form.submit()
  }

})
