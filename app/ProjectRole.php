<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    //

    public function userProject() {
        return $this->hasMany('App\UserProject');
    }
}
