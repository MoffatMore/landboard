<?php

namespace App;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    //
    protected $fillable = [
        'plot_no',
        'location',
        'address',
        'status',
        'owner_id'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->plot_no = IdGenerator::generate([
                'table' => 'plots',
                'length' => 6,
                'prefix' =>date('y'),
                'reset_on_prefix_change' => true,
                'field' => 'plot_no'
            ]);
        });
    }
}
