<?php

namespace App\Providers;

use App\Repo\Cart\CartModelRepo;
use App\Repo\Cart\CartRepo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepo::class,function(){
            return New CartModelRepo();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
