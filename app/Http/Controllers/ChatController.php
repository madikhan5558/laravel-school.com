<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\ChatModel;


class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $data['header_title'] = "My Chat";

        $sender_id = Auth::user()->id;

        if(!empty($request->receiver_id))
        {
            $receiver_id = base64_decode($request->receiver_id);
            if($receiver_id == $sender_id)
            {
                return redirect()->back()->with('error', 'Due to some error please try again');
                exit();
            }
            $data['getReceiver'] = User::getSingle($receiver_id);
        }
        return view('chat.list', $data);
    }
}
