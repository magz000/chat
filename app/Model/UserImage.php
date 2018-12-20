<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    protected $fillable = [
        'user_id', 'link'
    ];
}
