var stripe = Stripe('pk_test_1tmrqU5LNTyD10N10a657Xhn');


// var stripe = require("stripe")(
//     "sk_test_oZVNrFVvcQ7W7MujpdSO9uCA"
// );

var $form = $('#checkout-form');

$form.submit(function (event) {
    $('#charge-error').addClass('hidden');
    // $form.find('button').prop('disabled', true);
    stripe.card.createToken({
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val(),
        name: $('#card-name').val(),
        customer: $('#user-id').val()
    }, stripeResponseHandler);
    return false;
});


function stripeResponseHandler(status, response) {
    if (response.error) {
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text(response.error.message);
        $form.find('button').prop('disabled', false);

    } else {
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken"/>').val(token));

        // Submit the form
        $form.get(0).submit();
    }
}