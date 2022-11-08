@extends('layouts.app')

@section('content')
<div class="container bg-light" style="!important;height:80vh !important">
<div class="row"> 
    <div class="card bg-primary text-white col-sm-12 col-md-12">
        <div class="card-body">Total Subscription  {{$sub_amount ?? 0}}</div>
    </div>

    <div class="card mt-2  bg-light text-dark col-sm-12 col-md-12">
        <div class="card-body">
        <form method="post" action="/charge" name="search-theme-form" id="search-theme-form">
                  @csrf
            <h5>Change Mode of Payment: {{$default_card ?? 'Stripe'}}</h5>
            <select class="form-select" name="payment" onchange="setpayment(this)" aria-label="Default select example">
            <option disable>Change Payment Method</option>
            <option value="stripe" selected>Stripe</option>
            <option value="paystack">Paystack</option>
          </select>

        </div>
    </div>
   
          <div class="card mt-2  col-sm-12 col-md-12">
          
              <div class="card-body">
                <h4 class="card-title">@if(count($plan))
                                        {{$plan[0]->name}}: Plan
                                       @else
                                        Plan:Run "php artisan db:seed --class=PlanTableSeeder" to create a plan
                                       @endif </h4>
                <p class="card-text">Amount:
                                        @if(count($plan))
                                           {{$plan[0]->description}} 
                                        @else
                                          No plan has been created
                                        @endif 
                </p>
                
                  <input type="submit"  class="btn btn-success pay" value="Continue">
                </form>
                </div>
          </div>
          
      </div>
      </div>
      
    
</div>
@endsection
@section('scripts')

<script>
  
window.onload = function() {
  let frm = document.getElementById('search-theme-form') || null;
  frm.action = "/charge";
      
};
function setpayment(a){
   /*let action_name=a.value;
   let frm = document.getElementById('search-theme-form') || null;
 if(frm) {
  

    if( action_name=="stripe" ) {
          frm.action = "/charge";
      }
      else if( action_name=="paystack" ) {
          frm.action = "/pay";
      }
      else {
        frm.action = "/charge";
      }
  }*/
}
</script>
@endsection
