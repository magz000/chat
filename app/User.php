<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;


class User extends Authenticatable  implements JWTSubject
{
    use Messagable, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'name'
    ];

    protected $with = ['image'];


    public function getNameAttribute() {
        return $this->first_name .' '. $this->last_name;
    }

    public function image() {
        return $this->hasOne('App\Model\UserImage');
    }


    //JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
