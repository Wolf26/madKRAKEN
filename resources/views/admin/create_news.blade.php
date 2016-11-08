@extends('layouts.app')

@section('content')

<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create News</div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'news_store', 'class' => 'form', 'files' => true)) !!}

                    <div class="form-group">
                        {!! Form::label('News Title') !!}
                        {!! Form::text('title', null,
                            array('required',
                                  'class'=>'form-control',
                                  'placeholder'=>'News Title')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Content') !!}
                        {!! Form::textarea('content', null,
                            array('',
                                  'class'=>'form-control myTextarea',
                                  'placeholder'=>'content')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Images Link') !!}
                        {!! Form::file('images', null,
                            array('required',
                                  'class'=>'form-control',
                                  'placeholder'=>'The link of the images')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Create News.',
                          array('class'=>'btn btn-primary')) !!}
                    </div>
                    {!! Form::close() !!}
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                          {{Session::get('message')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
