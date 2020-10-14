<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectForumComment extends Model
{
    //

    public function projectForum() {
        return $this->belongsTo('App\ProjectForum');
    }
}
