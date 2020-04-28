<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
        'user_id',
        'last',
        'contacts',
        'gender',
        'dob',
        'postal_address',
        'physical_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
