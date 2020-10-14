<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectForum extends Model
{
    //

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function project() {
        return $this->belongsTo('App\project');
    }

    public function projectForumCommment() {
        return $this->hasMany('App\ProjectForumComment');
    }
}
