@extends('layouts/app')

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>{{ $title }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $posts as $post )
                <tr>
                    <td>{{ $post->id }}</td>
                    <td><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
