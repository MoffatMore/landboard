<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnershipTransfer extends Model
{
    //
    protected $fillable = [
        'plot_no',
        'owner_id',
        'transferee_id'
    ];

    public function plot()
    {
        return $this->belongsTo(Plot::class, 'plot_no','plot_no');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'owner_id', 'id');
    }
}
