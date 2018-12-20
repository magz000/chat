<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function system() {
        return $this->belongsToMany('App\Model\System', 'group_systems', 'group_id', 'system_id');
    }
}
