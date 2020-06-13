<?php
namespace App\Http\Controllers;

use App\Chat;
use DB;
use App\Events\ChatEvent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('chat.chat');
    }

    public function fetchAllMessages($id)
    {
        return DB::table('chats')->where('groupID', $id)->get();
    }

    public function sendMessage(Request $request)
    {
    	$chat = auth()->user()->messages()->create([
            'groupID' => $request->groupID,
            'message' => $request->message,
            'status' => 0
        ]);

/*
    	broadcast(new ChatEvent($chat->load('user')))->toOthers();
*/

    	return ['status' => 'success'];
    }



}
