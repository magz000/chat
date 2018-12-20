<?php

namespace App\Http\Controllers\Web\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function getusers(){
        return response([
            'result' => 'success',
            'users' => User::all()
        ], 200);
    }
}
