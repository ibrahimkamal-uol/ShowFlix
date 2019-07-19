@extends('layouts.app')

@section('content')
<div class ="container">
    <h1>Edit Actor Record</h1>
    {!! Form::open(['action' => ['ActorController@update', $actors->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('actorname', 'Actor Name')}}
            {{Form::text('actorname', $actors->actorname, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('actorbio', 'Actor Bio')}}
            {{Form::textarea('actorbio', $actors->actorbio, ['id' => 'article-ckeditor' , 'class' => 'form-control', 'placeholder' => 'Bio Text'])}}
        </div>
        <div class="form-group">
            {{Form::file('actor_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {!! Form::button('<h3>Submit <i class="fas fa-check"></i></h3>', array('type' => 'submit', 'class' => 'btn btn-link')) !!}
    {!! Form::close() !!}
@endsection