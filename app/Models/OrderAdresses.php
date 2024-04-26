<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdresses extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'street_adress',
        'city',
        'country',
        'postcode',
        'type',
        'email',
        'state',
        'order_id'

    ];
    // protected $guarded = [];
}