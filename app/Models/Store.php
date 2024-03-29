<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;
    //لو كنت عامل الجدول بصيغة الجمع مثلا
    // protected $table = 'stores';
    // علشان اعرف الجدول الخاص بالموديل دا
    // ------------------------------------------
    // protected $primaryKey = 'id';
    // هنا مثلا لو كنت مغير ال برايمرى كى ل الاسم مثلا او اى حاجة تانى

    /**
     * Get all of the comments for the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }


}
