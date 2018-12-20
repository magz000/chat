<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\System;


class SystemController extends Controller
{
    public function index() {
        // $res = System::where('status', 1)->get();
        $res = System::all();

        return response([
            'success' => true,
            'systems' => $res
        ]);
    }

    public function systemsActive() {
        $res = System::where('status', 1)->get();

        return response([
            'success' => true,
            'systems' => $res
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:systems'
        ]);

        $new = new System;
        $new->name = $request->name;
        $new->status = 1;
        $new->save();

        return response([
            'success' => true,
            'system' => $new
        ]);
    }


    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:systems,id,'.$id,
            'status' => 'required'
        ]);

        $res = System::find($id);

        if(!$res) {
            return response([
                'success' => false,
                'message' => 'Invalid System ID'
            ]);
        }

        $res->name = $request->name;
        $res->status = $request->status;
        $res->save();

        return response([
            'success' => true,
            'system' => $res
        ]);
    }

    public function delete($id) {
        $res = System::find($id);

        if(!$res) {
            return response([
                'success' => false,
                'message' => 'Invalid System ID'
            ]);
        }

        $res->delete();

        return response([
            'success' => true,
            'message' => 'System Successfully Deleted'
        ]);

    }
}
