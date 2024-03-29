<?php
namespace App\Facades;

use App\Repo\Cart\CartRepo;
// use Facade;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CartRepo::class;
    }
}

