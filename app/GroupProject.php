<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupProject extends Model
{
    protected $fillable = [
        'group_id', 'project_id', 'program_id'
    ];
}
