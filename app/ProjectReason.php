<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectReason extends Model
{
    protected $fillable = [
        'supervisor_id', 'reason', 'project_id', 'program_id'
    ];
}
