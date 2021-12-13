<?php

namespace App\Providers;

use App\Contract\PusherInterface;
use App\Services\RealTime\Pusher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       $toBind = [
           PusherInterface::class => Pusher::class
        ];

       foreach ($toBind  as $interface => $class ){
           $this->app->bind($interface,$class);
       }
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
