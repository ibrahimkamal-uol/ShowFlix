@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Create Record</h1>
    {!! Form::open(['action' => 'TestdbController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor' , 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>

            {{Form::label('cast', 'Cast')}}
                <select class="form-control select2-multi" name="actors[]" multiple="multiple">
                    @foreach($actors as $actor)
                        <option value='{{$actor->id}}'>{{ $actor->actorname }}</option>
                    @endforeach
                </select>

        <div class="form-group">
            {{Form::label('youtube', 'Youtube')}}
            {{Form::text('youtube', '', ['class' => 'form-control', 'placeholder' => 'Youtube Link'])}}
        </div>
        
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {!! Form::button('<h3><i class="fas fa-check"></i></h3>', array('type' => 'submit', 'class' => 'btn btn-link')) !!}
    {!! Form::close() !!}
    @endsection


