<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Payment\Gateway;
use App\Payment\Stripe;
use App\Payment\Paystacks;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Gateway::class,function($app,$payment_type){
           
            if($payment_type['type'] ==1){
                return new Stripe();
            }
           return new Paystacks();
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
