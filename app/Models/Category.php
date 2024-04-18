<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'image', 'status', 'description', 'parent_id', 'slug'];

    /**
     * Get the user associated with the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    public function scopeInactive(Builder $builder)
    {
        $builder->where('status', '=', 'inactive');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(category::class, 'parent_id', 'id')->withDefault([
            'no parent'
        ]);
    }

    static function rules()
    {
        return [
            'name' => 'required|min:3|max:255|string',
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'img' => ['image', 'mimes:png,jpg', 'max:1024', 'dimensions:min_width=100,min_height=100'], //max بالكيلوبايت
            'status' => 'in:active,inactive'


        ];
    }


    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        // return $this->hasMany(Product::class); //دا لو ملتزم ب الكى الافتراضية
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}