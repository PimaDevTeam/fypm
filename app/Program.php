<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //


    public function department() {
        return $this->belongsTo('App\Department');
    }

    public function user() {
        return $this->hasMany('App\User');
    }

    public function gradeRequirement() {
        return $this->hasMany('App\GradeRequirement');
    }
}
