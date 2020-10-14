<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeRequirement extends Model
{
    

    public function session() {
        return $this->belongsTo('App\Session');
    }

    public function program() {
        return $this->belongsTo('App\Program');
    }
}
