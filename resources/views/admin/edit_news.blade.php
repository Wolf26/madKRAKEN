@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit News</div>
                <div class="panel-body">
                    <ul>
                            @foreach($news as $post)
                        <li><a class="info" href="/admin/edit-news-selected/{{ $post->id }}-{{ $post->slug }}">{{ $post->title }}</a></li>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
