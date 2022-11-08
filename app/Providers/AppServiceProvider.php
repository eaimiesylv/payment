<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Payment\Gateway;
use App\Payment\Stripe;
use App\Payment\Paystack;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Gateway::class,function($app){

            return new Paystack();
            return new Stripe();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
