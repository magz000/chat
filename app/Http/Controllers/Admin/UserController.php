<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index() {
        $res = User::all();

        return response([
            'success' => true,
            'users' => $res
        ]);
    }


    public function changeStatus($id) {
        $res = User::find($id);

        if(!$res) {
            return response([
                'success' => false,
                'message' => 'Invalid ID'
            ]);
        }

        $res->status = $res->status ? 0 : 1;
        $res->save();

        return response([
            'success' => true,
            'user' => $res,
            'message' => 'Status successfully changed'
        ]);
    }
}
