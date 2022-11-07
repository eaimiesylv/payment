@extends('layouts.app')

@section('content')
<div class="container bg-light" style="!important;height:80vh !important">
<div class="row"> 
    <div class="card bg-primary text-white col-sm-12 col-md-12">
        <div class="card-body">Total Subscription  {{$sub_amount}}</div>
    </div>
    <div class="card mt-2  bg-light text-dark col-sm-12 col-md-12">
        <div class="card-body">
       
            <h5>Default Mode of Payment: {{$default_card}}</h5>
            <select class="form-select" aria-label="Default select example">
            <option selected>Change Payment Method</option>
            <option value="1">Stripe</option>
            <option value="2">Paystack</option>
          </select>

        </div>
    </div>
   
          <div class="card mt-2  col-sm-12 col-md-12">
          
              <div class="card-body">
                <h4 class="card-title">{{$plan[0]->name}} Plan:</h4>
                <p class="card-text">Amount:{{$plan[0]->description}}</p>
                <a href="#" class="btn btn-primary"></a>
                </div>
          </div>
          
      </div>
      </div>
      
    
</div>
@endsection
@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create a Stripe client.
var stripe = Stripe('{{ env("STRIPE_KEY") }}');

// Create an instance of Elements.
var elements = stripe.elements();


var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  
  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'text');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  
  // Submit the form
  form.submit();
}
</script>
@endsection
