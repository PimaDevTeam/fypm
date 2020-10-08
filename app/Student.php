<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'matric_number',
        'degree',
        'user_id',
        'image',
    ];

    protected $hidden = [
        'password'
    ];

    public function user() {
        return $this->hasOne('App\User');
    }
}
