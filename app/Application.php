<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $fillable = [
        'user_id',
        'plot_location',
        'plot_address',
        'status',
    ];
}
