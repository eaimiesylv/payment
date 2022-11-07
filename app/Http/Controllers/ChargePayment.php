<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require_once('../vendor/autoload.php');

class ChargePayment extends Controller
{
   
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
	
    $customer = Stripe\Customer::create(array(
            "address" => [
                "line1" => "Virani Chowk",
                "postal_code" => "390008",
                "city" => "Vadodara",
                "state" => "GJ",
                "country" => "IN",
            ],
            "email" => "demo@gmail.com",
            "name" => "Nitin Pujari",
            "source" => $request->stripeToken
        ));
    try{
            Stripe\Charge::create ([
                    "amount" => -100 * 100,
                    "currency" => "usd",
                    "customer" => $customer->id,
                    "description" => "Test payment from LaravelTus.com.",
                    "shipping" => [
                        "name" => "Jenny Rosen",
                        "address" => [
                            "line1" => "510 Townsend St",
                            "postal_code" => "98140",
                            "city" => "San Francisco",
                            "state" => "CA",
                            "country" => "US",
                        ],
                    ]
            ]); 
			}
		 catch (Throwable $e) {
			report($e);
			dd('error');
			return false;
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
