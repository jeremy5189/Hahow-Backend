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
        
        /*
         * 取得所有聊天紀錄（方法一）
         *
         * 為了幫助同學們快速理解關聯資料庫的概念
         * 這裡示範了最直觀的方法
         * 但下面會解釋為什麼這個方法不好
         */

        $chat = Chat::all(); // 取的 Chat 資料表內所有資料（*查詢資料庫一次）

        /* $chat 範例輸出(節錄集中一個物件)：
            App\Chat {#715
                id: 1,
                author: 1,
                message: "hello",
                created_at: "2016-09-25 16:50:46",
                updated_at: "2016-09-25 16:50:46",
            }
        */
        
        foreach( $chat as $item ) { // *查詢資料表 count($chat) 次（即 chat 資料表的總資料量）

            /*
             * 因為 App\Chat 的 Model 中已經定義
             * author() 方法
             * 故可以透過這樣的方式關聯取得 chat.author = user.id 的資料
             */

            $item->author = $item->author()->first()->name; // 只取了 name 屬性

            /* $item 範例輸出：
                App\Chat {#715
                    id: 1,
                    author: "Jeremy",  # 注意，此非物件
                    message: "hello",
                    created_at: "2016-09-25 16:50:46",
                    updated_at: "2016-09-25 16:50:46",
                }
            */
        }

        return $chat;
    }

    public function all_better() {

        /*
         * 取得所有聊天紀錄（方法二）
         *
         * 上述方法一雖然直觀簡單
         * 但注意 (*) 號部分，我們總共查詢了資料庫（執行 SQL 命令）N + 1 次
         * 若 Chat 資料表內資料不多可能還好，但是隨著資料增多，N 也會越來越大
         * 造成**效能不佳**的問題
         *
         * Laravel 提供了一個方便的 with() 函數
         * 稱為 Eager Loading (https://laravel.com/docs/5.4/eloquent-relationships#eager-loading)
         * 可以幫助我們在 1 + 1 次的 SQL 解決這個問題
         */

        return Chat::with('author')->get(); 

        /*
         * 不管 Chat 資料表內有多少資料
         * Laravel 都會先執行一次 SQL:
         *  
         *     SELECT * FROM `chat`;
         *
         * 然後取得所有不重複的 author 欄位（例如總共有三位使用者, ID 分別為 1, 2, 3) 
         * 再執行第二次 SQL:
         *
         *     SELECT * FROM `users` WHERE `users`.`id` in (1, 2, 3);
         * 
         * 即可在 1 + 1 次 SQL 內獲得所有所有資料
         *
         * 輸出範例節錄：
         *
            App\Chat {#746
                id: 1,
                author: App\User {#763  # 注意，此為 with 帶出的 user 物件
                    id: 1,
                    name: "Jeremy",
                    email: "jeremy5189@gmail.com",
                    created_at: "2016-09-15 16:38:06",
                    updated_at: "2016-09-18 00:31:15",
                },
                message: "hello",
                created_at: "2016-09-25 16:50:46",
                updated_at: "2016-09-25 16:50:46",
            }
         */
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
