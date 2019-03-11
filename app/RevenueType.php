<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueType extends Model
{
    protected $table = 'revenue_types';

    protected $fillable = ['label'];
}
