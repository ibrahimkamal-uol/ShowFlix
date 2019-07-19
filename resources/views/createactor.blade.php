@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Actor Record</h1>
    {!! Form::open(['action' => 'ActorController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('actorname', 'Actor Name')}}
            {{Form::text('actorname', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('actorbio', 'Actor Bio')}}
            {{Form::textarea('actorbio', '', ['id' => 'article-ckeditor' , 'class' => 'form-control', 'placeholder' => 'Bio Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('actor_image')}}
        </div>
        {!! Form::button('<h3><i class="fas fa-check"></i></h3>', array('type' => 'submit', 'class' => 'btn btn-link')) !!}
    {!! Form::close() !!}
@endsection