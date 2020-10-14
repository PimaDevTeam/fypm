<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    public function projectForum() {
        return $this->hasMany('App\ProjectForum');
    }

    public function userProject() {
        return $this->hasMany('App\UserProject');
    }

    public function projectStatus() {
        return $this->belongsTo('App\ProjectStatus');
    }
}
