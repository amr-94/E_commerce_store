<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['cookie_id', 'user_id', 'product_id', 'quantity'];


    protected static function booted()
    {


        static::observe(CartObserver::class);
    }




    /**
     * Get the user that owns the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    /**
     * Get the products that owns the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }



    /**
     * Get the user that owns the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
}
