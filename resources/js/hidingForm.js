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
