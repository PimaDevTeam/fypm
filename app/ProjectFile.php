<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{

    protected $fillable = [
        'description', 'project_id', 'project_file', 'student_id'
    ];

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }
}
