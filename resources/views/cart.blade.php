@extends('layouts/app')

@section('script')
<script>
$(function() {

    $.getJSON('/products/list_cart', function(resp) {
        for( var index in resp ) {
            var obj = resp[index];
            $('#tbody').append('<tr><td>' + obj.id + '</td><td>'+obj.name+'</td><td>'+obj.price+'</td>' +
                                '</tr>'
        );
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
