@extends('layouts.app')

@section('content')
<div class="container bg-light" style="!important;height:80vh !important">
<div class="row"> 
    <div class="card bg-primary text-white col-sm-12 col-md-12">
    @if($type == 'stripe')
        <div class="card-body">Stripe Payment:Enter Your Card Detail  </div>
    @else
    <div class="card-body">Paystack Payment:Amount  </div>
      @endif
    </div>
    

    <div class="card">
               <form method="POST" action="/pay"  id="payment-form" class="card-form mt-3 mb-3">
						@csrf
						<input type="hidden" name="payment_method" class="payment-method">
						<!--<input class="StripeElement mb-3" name="card_holder_name" placeholder="Card holder name" required>-->
            <input class="StripeElement mb-3" name="amount" placeholder="Enter Amount" required>
            @if($type == 'stripe')
						<div class="col-lg-4 col-md-6">

           
							<div id="card-element"></div>
						</div>
            @endif
						<div id="card-errors" role="alert"></div>
						<div class="form-group mt-3">
							<button type="submit" class="btn btn-primary pay">
								Add Subscription
							</button>
						</div>
         </form>
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

function setpayment(a){
   let action_name=a.value;
   let frm = document.getElementById('search-theme-form') || null;
 if(frm) {
  

    if( action_name=="stripe" ) {
          frm.action = "/charge";
      }
      else if( action_name=="paystack" ) {
          frm.action = "/pay3";
      }
      else {
        frm.action = "/pay2";
      }
  }
}
</script>
@endsection
