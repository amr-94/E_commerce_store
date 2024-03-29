<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class profile extends Model
{
    use HasFactory;
    // protected $primartkey = 'user_id';
    protected $fillable = ['user_id','first_name','last_name','birthday','gender','city','address','country','profile_image','local'];

    /**
     * Get the user that owns the profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
