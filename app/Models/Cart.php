<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['cookie_id', 'user_id', 'product_id', 'quantity'];


   protected static function booted()
     {
        //هنا بحددله فى حالة حدوذ حدث مثلا يعمل ايه
        // يعنى ممكن مثلا اقوله لما يحصل حذف ف جدول مثلا يبقى تحدف الصورة بتاعته
    //     static::creating(function (Cart $cart) {
    //         $cart->id = Str::uuid();
    //     });

            static::observe(CartObserver::class);
            // واستدعيها هنا
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
