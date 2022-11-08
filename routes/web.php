<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');//paystack
Route::get('/payment/{callback}', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback'])->name('payment');//paystack
Route::post('/charge', [App\Http\Controllers\ChargePaymentController::class, 'store']);///stripe
Route::get('/allpayment', [App\Http\Controllers\AllpaymentController::class, 'charge']);///
