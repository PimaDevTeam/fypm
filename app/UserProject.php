<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{

    protected $fillable = [
        'student_id', 'project_id', 'supervisor_id', 'session_id' 
    ];
    //

    // public function projectRole() {
    //     return $this->belongsTo('App\ProjectRole');
    // }

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function users() {
        return $this->belongsTo('App\User');
    }

    
}
