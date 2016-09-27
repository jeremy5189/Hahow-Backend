<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Product::all();
    }

    public function list() {
        return view('product-list');
    }

    public function add_cart(Request $request, $id) {

        // 取得已經存在 session 的資料
        $prev = $request->session()->get('cart');

        // 預設 arr 為空
        $arr  = [];

        // 如果 prev 已經含有資料 則先 decode 到 arr
        if( $prev != null ) {
            $arr = json_decode($prev);
        }

        // 從尾部新增內容（ 同 push )
        $arr[] = $id;

        // 存回 Session
        $request->session()->put('cart', json_encode($arr));

        return [
            'status' => true
        ];
    }

    public function list_cart(Request $request) {

        // 取得 session 裡面的資料
        $id_list = json_decode($request->session()->get('cart'));

        $prod_list = [];

        // 根據 Product ID 取得每筆商品資料
        foreach($id_list as $id) {
            $prod_list[] = Product::find($id);
        }

        return $prod_list;
    }

    public function cart() {
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
