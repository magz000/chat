<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    protected $guard = 'admin';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function username() {
        return 'username';
    }

    public function name() {
        return $this->first_name .' '. $this->last_name;
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
