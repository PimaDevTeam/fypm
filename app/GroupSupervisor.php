<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSupervisor extends Model
{
    protected $fillable = [
        'group_id', 'supervisor_id'
    ];
}
