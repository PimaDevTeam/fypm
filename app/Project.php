<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    public function projectForum() {
        return $this->hasMany('App\ProjectForum');
    }

    public function user() {
        return $this->belongsToMany('App\User');
    }

    public function projectStatus() {
        return $this->belongsTo('App\ProjectStatus');
    }
}
