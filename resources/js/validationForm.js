const title = document.getElementById('Title')
const n_rooms = document.getElementById('N_of_rooms')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) => {
    e.preventDefault()
  let messages = []
  if (title.value === '' || title.value == null) {
    messages.push('Il titolo è obbligatorio')
  }

  if (n_rooms.value < 0) {
    messages.push('Il numero non può essere un valore negativo')
    console.log(messages)
  }

  if (messages.length > 0) {
    errorElement.innerText = messages.join(', ')
  } else {
    form.submit()
  }

})


const formDelete = document.querySelector('#formDelete')
const baseAction = window.location.origin + '/admin/houses-image/*****'

const deleteButtons = document.querySelectorAll('[data-image]')
.forEach(ele => {
    ele.addEventListener('click', function() {
        formDelete.action = baseAction
        formDelete.action = formDelete.action.replace('*****', ele.dataset.image)
    }) 
})
