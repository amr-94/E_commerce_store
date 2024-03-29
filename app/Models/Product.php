<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['store_id', 'category_id', 'slug', 'name', 'description', 'image', 'price', 'compare_price', 'optins',
     'rating', 'featured', 'status', 'user_id'];

    /**
     * Get the user associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ------------ many to many
    /**
     * The roles that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class, // الجدول الوسيط related model
            'product_tag', //اسم الجدول الوسيط, pivot table name
            'product_id', // دا ال فورين كى بتاع الجدول اللى انا فيه حاليا FK in pivot table for current model
            'tag_id', // الفورن كى بتاع الجدول التانى FK in pivot table for related model
            'id', // pk current model
            'id' // pk related model





        );
    }
}
