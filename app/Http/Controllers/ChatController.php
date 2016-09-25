<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Chat;
use Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('chat');
    }

    public function all() {
        $chat = Chat::all();
        foreach( $chat as $item ) {
            $item->author = $item->author()->first()->name;
        }
        return $chat;
    }

    public function create(Request $request) {
        $message = $request->input('message');
        $data = [
            'message' => $message,
            'author'  => Auth::user()->id
        ];
        return Chat::create($data);
    }
}
