<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    //
    protected $fillable = [
        'location',
        'address',
        'closing_date',
    ];
}
