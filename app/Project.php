<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name', 'proposed_by', 'project_program_id', 'project_description', 'project_status_id', 'project_file'
    ];

    public function projectForum() {
        return $this->hasMany('App\ProjectForum');
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function projectStatus() {
        return $this->belongsTo('App\ProjectStatus');
    }

    public function programs() {
        return $this->belongsTo('App\Program');
    }
}
