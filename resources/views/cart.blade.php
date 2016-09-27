@extends('layouts/app')

@section('script')
<script>
$(function() {

    // 發起 AJAX 要求
    $.getJSON('/products/list_cart', function(resp) {

        for( var index in resp ) {

            var obj = resp[index];

            // 將資料加入 table 中
            $('#tbody').append('<tr><td>' + obj.id + '</td><td>'+obj.name+'</td><td>'+obj.price+'</td>' +
                                '</tr>');
        }
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>購物車</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>商品名稱</th>
                    <th>
                        價格
                    </th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
        <a href="/products" class="btn btn-danger">繼續購物</a>
    </div>
</div>

@endsection
