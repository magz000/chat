<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin;

class AdminController extends Controller
{
    public function index () {
        $res = Admin::all();

        return response([
            'success' => true,
            'accounts' => $res
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'username' => 'required|unique:admins',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $new = new Admin;
        $new->username = $request->username;
        $new->password = bcrypt($request->password);
        $new->first_name = $request->first_name;
        $new->last_name = $request->last_name;
        $new->status = 1;
        $new->save();

        return response([
            'success' => true,
            'account' => $new
        ]);
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);


        $admin = Admin::find($id);
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->save();

        return response([
            'success' => true,
            'account' => $admin
        ]);
    }

    public function changeStatus($id) {
        $res = Admin::find($id);

        $res->status = $res->status ? 0 : 1;
        $res->save();

        return response([
            'success' => true,
            'account' => $res
        ]);
    }
}
