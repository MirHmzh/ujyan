<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    public function id()
    {
    	return $this->belongsTo('App\User','id');
    }
}
