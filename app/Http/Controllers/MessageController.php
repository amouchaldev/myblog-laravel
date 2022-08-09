<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request) {
        $request->validate([
            'fullName' => 'required|min:7',
            'email' => 'email|required',
            'content' => 'required|min:20|max:255',
        ]);
        $message = new Message($request->except('_token'));
        if ($message->save()) {
            return redirect('/#contact-us')->with('success', 'Your Message Send Successfully');
        }
    }

    public function fetchMessages() {
        $messages = Message::all();
        return view('messages.index', ['messages' => $messages]);
    }
}
