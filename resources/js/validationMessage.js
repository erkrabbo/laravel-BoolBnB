const formDelete = document.querySelector('#formDelete')
const baseAction = window.location.origin + '/dashboard/messages/*****'

const deleteButtons = document.querySelectorAll('[data-image]')
.forEach(ele => {
    ele.addEventListener('click', function() {
        formDelete.action = baseAction
        formDelete.action = formDelete.action.replace('*****', ele.dataset.image)
    }) 
})