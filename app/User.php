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
        'first_name', 'last_name', 'email', 'phone_number', 'role_id', 'department_id', 'gender'
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

    public function role()
    {
        return $this->belongsTo('App\Role');
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

    public function userProject() {
        return $this->hasMany('App\UserProject');
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
