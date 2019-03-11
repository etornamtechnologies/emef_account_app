<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpendictureType extends Model
{
    protected $table = 'expendicture_types';

    protected $fillable = ['label'];
}
