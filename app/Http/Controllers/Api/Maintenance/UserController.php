<?php

namespace App\Http\Controllers\Api\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserImage;
use App\User;
use Chat;
use DB;

class UserController extends Controller
{
    public function getusers(){
        $users = User::where('id', '<>', auth()->user()->id)
                    ->get();

        return response([
            'success' => true,
            'users' => $users
        ], 200);
    }


    public function store(Request $request) {
        $this->validate($request, [
            'email' => "required|email|unique:users",
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        DB::begintransaction();

        try {
            $user = new User;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->save();

            if($request->image) {
                UserImage::updateOrCreate([
                    'user_id' => $user->id
                ], [
                    'link' => $request->image
                ]);
            }

            DB::commit();
            return ([
                'success' => true,
                'message' => 'User Successfully Created',
                'user' => $user->load('image')
            ]);
        }catch(\Exception $e) {
            DB::rollback();
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }


    }


    public function update(Request $request, $id){
        $this->validate($request, [
            'email' => "required|email|unique:users,email,$id",
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        DB::begintransaction();

        try {
            $user = User::find($id);
            $user->email = $request->email;
            $user->password = $request->password;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->save();

            if($request->image) {
                UserImage::updateOrCreate([
                    'user_id' => $user->id
                ], [
                    'link' => $request->image
                ]);
            }

            DB::commit();
            return ([
                'success' => true,
                'message' => 'User Successfully Updated',
                'user' => $user->load('image')
            ]);

        }catch(\Exception $e) {
            DB::rollback();
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }


    }

    public function markAllAsRead() {
        $user = auth()->user();

        $conversations = Chat::conversations()->for($user)->get();

        foreach($conversations as $conv) {
            Chat::conversation($conv)->for($user)->readAll();
        }

        $unreadCount = Chat::messages()->for($user)->unreadCount();

        return response([
            'success' => true,
            'message' => 'Successfully Updated',
            'unread'  => $unreadCount
        ]);

    }
}
