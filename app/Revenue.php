<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $table = 'revenues';

    protected $guarded = [];

    public function revenue_type()
    {
        return $this->belongsTo('App\RevenueType');
    }
}
