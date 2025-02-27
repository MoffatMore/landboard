<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
        'user_id',
        'last',
        'identifier',
        'id_no',
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
