<?php

namespace App\Http\Controllers\Web\Musonza;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Chat;
use App\Events\SendMessage;

class ConversationController extends Controller
{
    public function index(){
        $user = auth()->user();

        $conversations = Chat::conversations()->for($user)->get();

        foreach($conversations as $conv) {
            $conv['unread'] = Chat::conversation($conv)->for($user)->unreadCount();
        }

        return view('conversations.index', [
            'conversations' => collect($conversations->load('users'))
        ]);
    }

    public function create(){

    }

    public function store(Request $request){
        $user = auth()->user();
        $participants = $request->users;
        array_push($participants, $user->id);
        $conversation = Chat::createConversation($participants);

        $data = ['title' => $request->title];
        $conversation->update(['data' => $data]);

        return [
            'result' => 'success',
            'message' => 'Conversation successfully created',
            'conversation' => $conversation
        ];
    }

    public function show($id){
        $conversation = Chat::conversations()->getById($id);
        $user = auth()->user();

        if (!$conversation->users->contains($user)) {
            return redirect('/conversations');
        }

        Chat::conversation($conversation)->for($user)->readAll();

        $page = isset($request->page) ? $request->page : 1;

        $params = [
            'sorting' => 'desc',
            'page' => $page
        ];

        $messages = Chat::conversation($conversation)->for($user)->setPaginationParams($params)->getMessages();

        return view('conversations.show', ['conversation' => $conversation, 'messages' => collect($messages->items())]);

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

    public function addParticipants($id, Request $request){
        $conversation = Chat::conversations()->getById($id);
        Chat::conversation($conversation)->addParticipants($request->user);

        return [
            'result' => 'success',
            'message' => 'User successfully added',
            'users' => $conversation->users
        ];

    }

    public function getMessages(Request $request, $id){
        $conversation = Chat::conversations()->getById($id);
        $user = auth()->user();

        $page = isset($request->page) ? $request->page : 1;

        $params = [
            'sorting' => 'desc',
            'page' => $page
        ];

        $messages = Chat::conversation($conversation)->for($user)->setPaginationParams($params)->getMessages();

        return $messages;


    }

    public function sendMessage($id, Request $request){

        $user = auth()->user();
        $conversation = Chat::conversations()->getById($id);

        $temp = Chat::message($request->message)
                        ->from($user)
                        ->to($conversation)
                        ->send();

        $message = Chat::messages()->getById($temp->id);
        //
        event(new SendMessage($message->load('sender')));

        return [
            'result' => 'success',
            'message' => $message
        ];
    }


    public function sendFile(Request $request, $id){
        $user = auth()->user();
        $conversation = Chat::conversations()->getById($id);

        $extension = $request->upl->extension();
        if(in_array($extension, ['jpg', 'jpeg', 'png', 'bmp', 'gif'])){
            $type = 'image';
        }else{
            $type = 'file';
        }

        $filename = $request->upl->getClientOriginalName();

        $message = [
            'filename' => $filename,
            'path' => $request->upl->store('chat/conversations/'.$conversation->id)
        ];


        $temp = Chat::message(json_encode($message))
                        ->type($type)
                        ->from($user)
                        ->to($conversation)
                        ->send();

        $message = Chat::messages()->getById($temp->id);
        //
        event(new SendMessage($message->load('sender')));

        return [
            'result' => 'success',
            'message' => $message
        ];
    }


    public function markAllRead($id){
        $conversation = Chat::conversations()->getById($id);
        $user = auth()->user();

        Chat::conversation($conversation)->for($user)->readAll();

        return [
            'result' => 'success',
            'conversation' => $conversation
        ];
    }

    public function getUnreadPerConvo($id){
        $user = auth()->user();
        $conversation = Chat::conversations()->getById($id);
        Chat::conversation($conversation)->for($user)->unreadCount();
        return [
            'result' => 'success',
            'count' => $unreadCount
        ];
    }
}
