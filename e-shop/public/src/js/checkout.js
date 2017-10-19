var stripe = Stripe('pk_test_1tmrqU5LNTyD10N10a657Xhn');

var elements = stripe.elements();

var style = {
    base: {
        // Add your base input styles here. For example:
        fontSize: '16px',
        lineHeight: '24px'
    }
};

// Create an instance of the card Element
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>
card.mount('#card-element');

card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Create a token or display an error when the form is submitted.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}


// var stripe = require("stripe")(
//     "sk_test_oZVNrFVvcQ7W7MujpdSO9uCA"
// );

// var $form = $('#checkout-form');
//
// $form.submit(function (event) {
//     $('#charge-error').addClass('hidden');
//     // $form.find('button').prop('disabled', true);
//     stripe.card.createToken({
//         number: $('#card-number').val(),
//         cvc: $('#card-cvc').val(),
//         exp_month: $('#card-expiry-month').val(),
//         exp_year: $('#card-expiry-year').val(),
//         name: $('#card-name').val(),
//         customer: $('#user-id').val()
//     }, stripeResponseHandler);
//     return false;
// });
//
//
// function stripeResponseHandler(status, response) {
//     if (response.error) {
//         $('#charge-error').removeClass('hidden');
//         $('#charge-error').text(response.error.message);
//         $form.find('button').prop('disabled', false);
//
//     } else {
//         var token = response.id;
//         $form.append($('<input type="hidden" name="stripeToken"/>').val(token));
//
//         // Submit the form
//         $form.get(0).submit();
//     }
// }