<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once('../vendor/autoload.php');
/*
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//php artisan db:seed --class=UserTableSeeder
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/{callback}', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback'])->name('payment');
Route::post('/charge', function(Request $request){
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
});
