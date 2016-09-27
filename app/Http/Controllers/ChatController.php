<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Chat;
use Auth;

class ChatController extends Controller
{
    // auth 中介軟體 確保使用者登入後才能瀏覽
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('chat');
    }

    public function all() {
        $chat = Chat::all();
        foreach( $chat as $item ) {
            // 用 author (user_id) 關聯到 user 表
            $item->author = $item->author()->first()->name;
        }
        return $chat;
    }

    public function create(Request $request) {

        // 取得 input POST 資料
        $message = $request->input('message');

        // 建立 Create 欄位
        $data = [
            'message' => $message,
            'author'  => Auth::user()->id
        ];

        return Chat::create($data);
    }
}
