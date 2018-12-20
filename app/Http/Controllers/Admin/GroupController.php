<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Group;
use App\Model\GroupSystem;
use DB;

class GroupController extends Controller
{
    public function index() {
        $res = Group::with('system')->get();

        return response([
            'success' => true,
            'groups' => $res
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:groups',
            // 'system' => 'required'

        ]);

        DB::begintransaction();

        try {
            $new = new Group;
            $new->name = $request->name;
            $new->status = 1;
            $new->save();

            foreach($request->system as $system) {
                $new_gs = new GroupSystem;
                $new_gs->group_id = $new->id;
                $new_gs->system_id = $system['id'];
                $new_gs->status = 1;
                $new_gs->save();
            }

            DB::commit();

            return response([
                'success' => true,
                'group' => $new->load('system')
            ]);
        }catch(\Exception $e) {
            DB::rollback();

            return response([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:groups,id,'.$id,
            // 'system' => 'required'

        ]);

        DB::begintransaction();

        try {
            $res = Group::find($id);
            $res->name = $request->name;
            // $new->status = 1;
            $res->save();

            GroupSystem::where('group_id', $res->id)->delete();

            foreach($request->system as $system) {
                $new_gs = new GroupSystem;
                $new_gs->group_id = $res->id;
                $new_gs->system_id = $system['id'];
                $new_gs->status = 1;
                $new_gs->save();
            }

            DB::commit();

            return response([
                'success' => true,
                'group' => $new->load('system')
            ]);
        }catch(\Exception $e) {
            DB::rollback();

            return response([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function delete($id) {
        $res = Group::find($id);
        $res->delete();

        return response([
            'success' => true,
            'message' => 'Group Successfully Deleted'
        ]);

    }

    public function changeStatus($id) {
        $res = Group::find($id);

        $res->status = $res->status ? 0 : 1;
        $res->save();

        return response([
            'success' => true,
            'group' => $res
        ]);

    }
}
