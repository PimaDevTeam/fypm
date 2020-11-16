<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone_number', 'program_id', 'session_id', 'degree_id', 'matric_number', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function session() {
        return $this->belongsTo('App\Session');
    }

    public function program() {
        return $this->belongsTo('App\Program');
    }

    public function projectForum() {
        return $this->hasMany('App\ProjectForum');
    }

    public function Project() {
        return $this->belongsToMany('App\User');
    }

    public function semesterScore() {
        return $this->hasMany('App\SemesterScore');
    }

    public function degree() {
        return $this->belongsTo('App\Degree');
    }






    
    public function is_admin() {
        if($this->role_id) {
            return true;
        } else {
            return false;
        }
    }
}
