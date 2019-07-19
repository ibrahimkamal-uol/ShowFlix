@extends('layouts.app')
@section('content')
<div class ="container">
    <h1>Edit Record</h1>
    {!! Form::open(['action' => ['TestdbController@update', $db->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $db->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $db->body, ['id' => 'article-ckeditor' , 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        <div class="form-group">
              {{ Form::label('cast','Cast', ['class' => 'form-spacing-up']) }}
            {{ Form::select('actors[]', $actors, $db->actors->pluck('id')->toArray(), ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
            </div>
        <div class="form-group">
            {{Form::label('youtube', 'Youtube')}}
            {{Form::text('youtube', $db->youtube, ['class' => 'form-control', 'placeholder' => 'Youtube Link'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {!! Form::button('<h3>Submit <i class="fas fa-check"></i></h3>', array('type' => 'submit', 'class' => 'btn btn-link')) !!}
    {!! Form::close() !!}
@endsection