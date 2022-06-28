const dropin = require('braintree-web-drop-in');
const button = document.querySelector('#submit-button');
const hiddenNonceInput = document.querySelector('#prova')
const form = document.querySelector('#form')


dropin.create({
    authorization: 'sandbox_gp967cyr_6gbmtt3qhmmnktb8',
    container: '#dropin-container'
    }, function (createErr, instance) {

    button.addEventListener('click', function (e) {

    e.preventDefault()

    instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {

        hiddenNonceInput.value = payload.nonce;
        form.submit();

        });
    });
});
