<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //


    public function users() {
        return $this->hasMany('App\User');
    }

    public function gradeRequirements() {
        return $this->hasMany('App\GradeRequirement');
    }
}
