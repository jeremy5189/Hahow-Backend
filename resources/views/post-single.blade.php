@extends('layouts/app')

@section('script')
<script>
var post_id = {{ $id }};
$(function() {
    $.getJSON('/api/posts/' + post_id, function(data) {
        console.log(data);
        $('#title').html(data.title);
        $('#body').html(data.note);
        $('#body').append('<hr>' + data.created_at);
    });
});
</script>
@endsection

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" id="title">Title</div>

            <div class="panel-body" id="body">

            </div>
        </div>
    </div>
</div>

@endsection
