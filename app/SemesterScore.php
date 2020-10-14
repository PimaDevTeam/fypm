<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemesterScore extends Model
{
    //

    public function user() {
        return $this->belongsTo('App\User');
    }
}
