@extends('layouts/app')

@section('script')
<script>
$(function() {

    $(document).on('click', '.btn-add-cart', function() {
        var id = $(this).data('id');
        console.log(id + ' clicked');

        $.get('/products/add_cart/' + id, {}, function(resp) {
            if( resp.status ) {
                alert('加入購物車成功');
            }
        });
    });


    $.getJSON('/api/products', function(resp) {
        for( var index in resp ) {
            var obj = resp[index];
            $('#tbody').append('<tr><td>' + obj.id + '</td><td>'+obj.name+'</td><td>'+obj.price+'</td>' +
                                '<td><button data-id="' + obj.id  + '" class="btn btn-sm btn-primary btn-add-cart">加入購物車</button></td></tr>');
        }
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>All Products</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>商品名稱</th>
                    <th>
                        價格
                    </th>
                    <th>加入購物車</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
        <a href="/cart" class="btn btn-primary">結帳</a>
    </div>
</div>

@endsection
