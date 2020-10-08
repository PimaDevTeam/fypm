<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'phone_number',
        'image'
    ];

    public function user() {
        return $this->hasOne('App\User');
    }
}
