<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\ConversationCreated;
use App\User;
use Chat;

class ConversationController extends Controller
{
    public function index(){
        $user = auth()->user();

        $conversations = Chat::conversations()->for($user)->get();

        foreach($conversations as $conv) {
            $conv['unread'] = Chat::conversation($conv)->for($user)->unreadCount();
        }

        $conversations = $conversations->load('users');
        // $conversations = $conversations->load(['users' => function($query){
        //     $query->where('id', '!=', auth()->user()->id);
        // }]);

        return response([
            'success' => true,
            'conversations' => collect($conversations)
        ], 200);
    }

    public function store(Request $request){
        $user = auth()->user();
        $participants = $request->users;
        array_push($participants, $user->id);
        $conversation = Chat::createConversation($participants);

        // if($request->title) {
            $data = ['title' => $request->title];
            $conversation->update(['data' => $data]);
        // }

        $conv = Chat::conversations()->getById($conversation->id);

        $conv = $conv->load('users');
        // $conv = $conv->load(['users' => function($query){
        //     $query->where('id', '!=', auth()->user()->id);
        // }]);

        return [
            'success' => true,
            'message' => 'Conversation successfully created',
            'conversation' => $conv
        ];
    }

    public function update($id, Request $request){
        $conversation = Chat::conversations()->getById($id);

        $data = ['title' => $request->title];
        $conversation->update(['data' => $data]);

        return [
            'result' => 'success',
            'conversation' => $conversation
        ];
    }

    public function markAsRead($id) {
        $user = auth()->user();
        $conversation = Chat::conversations()->getById($id);

        Chat::conversation($conversation)->for($user)->readAll();

        $unreadCount = Chat::messages()->for($user)->unreadCount();

        return response([
            'success' => true,
            'message' => 'Successfully Updated',
            'unread'  => $unreadCount
        ]);
    }

    public function addParticipants($id, Request $request){
        $conversation = Chat::conversations()->getById($id);
        Chat::conversation($conversation)->addParticipants($request->user);

        $user = User::find($request->user);

        $conversation['unread'] = Chat::conversation($conversation)->for($user)->unreadCount();
        $conversation = $conversation->load('users');

        event(new ConversationCreated($request->user, $conversation));

        return [
            'result' => 'success',
            'message' => 'User successfully added',
            'users' => $conversation->users
        ];
    }


    



}
