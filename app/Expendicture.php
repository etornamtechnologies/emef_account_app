<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expendicture extends Model
{
    protected $table = 'expendictures';

    protected $guarded = [];

    public function expendicture_type()
    {
        return $this->belongsTo('App\ExpendictureType');
    }
}
