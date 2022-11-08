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
//Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');//process paystack
Route::get('/payment/{callback}', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback'])->name('payment');//process paystack
Route::post('/payment', [App\Http\Controllers\ChargePaymentController::class, 'charge']);//process stripe
Route::post('/pay', [App\Http\Controllers\AllpaymentController::class, 'charge']);///Receive all payment

Route::post('/charge', [App\Http\Controllers\HomeController::class, 'show']);

