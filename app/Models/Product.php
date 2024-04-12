<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pest\Support\Str;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'store_id', 'category_id', 'slug', 'name', 'description', 'image', 'price', 'compare_price', 'optins',
        'rating', 'featured', 'status', 'user_id'
    ];

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

    public function scopeFiltter(Builder $builder, $fillters)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active'
        ], $fillters);
        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', '=', $value);
        });
        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', '=', $value);
        });
        $builder->when($options['tag_id'], function ($builder, $value) {
            $builder->wherehas('tags', function ($builder, $value) {
                $builder->whereIn('tags.id', $value);
            });
        });
        $builder->when($options['status'], function ($builder, $value) {
            $builder->where('status', '=', $value);
        });
    }

    protected static function booted()
    {
        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }
}
