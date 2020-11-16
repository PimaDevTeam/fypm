<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name'
    ];


    public function department() {
        return $this->hasMany('App\Department');
    }
}

