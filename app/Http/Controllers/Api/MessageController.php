<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Chat;
use App\Events\SendMessage;
use App\Events\ConversationCreated;
use App\Events\MessageSent;
use App\User;

class MessageController extends Controller
{
    public function getMessages(Request $request, $id){
        $conversation = Chat::conversations()->getById($id);
        $user = auth()->user();

        $page = isset($request->page) ? $request->page : 1;

        $params = [
            'sorting' => 'desc',
            'page' => $page
        ];

        $messages = Chat::conversation($conversation)
                            ->for($user)
                            ->setPaginationParams($params)
                            ->getMessages();

        return $messages;
    }


    public function sendMessages(Request $request){
        $user = auth()->user();

        $conversation = $this->getConversation($request);

        if($request->upl) {
            $extension = $request->upl->extension();
            if(in_array($extension, ['jpg', 'jpeg', 'png', 'bmp', 'gif'])){
                $type = 'image';
            }else{
                $type = 'file';
            }

            $filename = $request->upl->getClientOriginalName();

            $message = json_encode([
                'filename' => $filename,
                'path' => $request->upl->store('chat/conversations/'.$conversation->id)
            ]);
        }else {
            $type = 'text';
            $message = $request->message;
        }

        $temp = Chat::message($message)
                        ->type($type)
                        ->from($user)
                        ->to($conversation)
                        ->send();

        $message = Chat::messages()->getById($temp->id);
        $message = $message->load('sender');
        //
        event(new SendMessage($message));

        $conversation['last_message'] = $message;

        // foreach($conversation->users->where('id', '<>', auth()->user()->id) as $usr) {

        foreach($conversation->users as $usr) {
            event(new MessageSent($usr, $message));
        }

        return [
            'success' => true,
            'message' => $message,
            'conversation' => $conversation
        ];
    }


    public function getUnreadCount() {
        $user = auth()->user();

        $unreadCount = Chat::messages()->for($user)->unreadCount();

        return [
            'success' => true,
            'unread' => $unreadCount
        ];
    }



    private function getConversation($request) {
        $user = auth()->user();

        if($request->conversation_id) {
            return Chat::conversations()->getById($request->conversation_id);
        }else{


            $users = explode(',', $request->users);

            $participants = $users;

            if(count($users) == 1) {
                $conversation = Chat::conversations()->between($user, $users[0]);

                if($conversation) {
                    return $conversation->load('users');
                }
                // return $conversation;

            }

            array_push($participants, $user->id);
            $conv = Chat::createConversation($participants);

            $conversation = Chat::conversations()->getById($conv->id);
            $conversation['unread'] = 1;
            $conversation = $conversation->load('users');
            // $conversation = $conversation->load(['users' => function($query){
            //     $query->where('id', '!=', auth()->user()->id);
            // }]);

            // dd($participants);
            // return $participants;

            foreach($participants as $u) {
                event(new ConversationCreated($u, $conversation));
            }

            return $conversation;

        }
    }


}
