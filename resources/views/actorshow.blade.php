@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <h1>{{$actors->actorname}}</h1></div></div></div>
    <div class="container">
    <div class="row">
        <div class="col-md-5">
    <img style="height: 500px;box-shadow: 10px 10px 10px black;border-radius: 30px" src="/storage/actor_images/{{$actors->actor_image}}">
    </div>
    <div class="col-md-7"> 
        {!!$actors->actorbio!!}
        </div> </div>
<div class="row" style="margin-left: 10px">
    @if (Auth::user()->id == $actors->user_id)
    <h2 class="btn btn-link"><a href="{{$actors->id}}/edit"><i class="fas fa-edit"></i></a></h2>
    {!! Form::open(['action' => ['ActorController@destroy', $actors->id], 'method' => 'POST', 'onsubmit' => 'return confirm("are you sure ?")']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {!! Form::button('<i class="fas fa-trash-alt"></i>', array('type' => 'submit', 'class' => 'btn btn-link')) !!}
                {!! Form::close() !!}
                @endif
</div>
<hr>
             <h2>Titles</h2> </div>
             <div class="container">     
                <div class="row"> 
                @foreach ($actors->tests as $test)
                <div class="col-2">
                    <a href="/testdb/{{$test->id}}" class="label label-defaul"><h3>{{ $test->title }}</h3></a>
                </div>
                @endforeach
                </div> </div>
@endsection