@extends('layouts/app')

@section('script')
<script>

// 取的網址 GET 參數
function getQueryParams(qs) {
    qs = qs.split('+').join(' ');

    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
    }

    return params;
}

var query = getQueryParams(document.location.search);
var page = '';

// 如果有 ?page=[int]
if( query.page != undefined )
    page = '?page=' + query.page;

$(function() {

    $.getJSON('/api/posts' + page, function(resp) {

        for( var index in resp.data ) {
            var obj = resp.data[index];
            $('#tbody').append('<tr><td>' + obj.id + '</td><td><a href="/posts/' + obj.id + '">' + obj.title + '</a></td></tr>');
        }

        // 如果沒有下一頁/上一頁 則不顯示按鈕
        if( resp.next_page_url == null ) {
            $('#btn-next').hide();
        } else if( resp.prev_page_url == null ) {
            $('#btn-pre').hide();
        }

        // 將翻頁 url 填入按鈕
        $('#btn-next').attr('href', resp.next_page_url.replace('api/', ''));
        $('#btn-pre').attr('href', resp.prev_page_url.replace('api/', ''));
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>All my posts</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
        <a class="btn btn-primary" id="btn-pre">Previous</a>
        <a class="btn btn-primary" id="btn-next">Next</a>
    </div>
</div>

@endsection
