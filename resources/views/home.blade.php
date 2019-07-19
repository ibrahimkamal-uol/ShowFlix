@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
    <a href="testdb/create"> <span class="badge"><h3>Create New Feed <i class="fas fa-plus"></i></h3></span></a><br>    
</div>
<div class="col-md-6">
    <a style="margin-left: 300px;" href="actor/create"><span class="badge"><h3>Create New Actor
<i class="fas fa-plus"></i></h3></span></a><br>
</div>
</div>
</div>
<div class="container"> 
    <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($tests) > 0)
                            @foreach($tests as $test)
                            <div class="col-md-4">
                                <div class="card bg-dark mb-3" style="width:350px;box-shadow: 10px 10px 10px black;border-radius: 30px">
                                    <a href="testdb/{{$test->id}}"-><img style="width:350px;height: 350px;object-fit: cover;border-radius: 30px" src="/storage/cover_images/{{$test->cover_image}}"></a>
                                     <div class="card-body">
                                        <h3 align="center"> <a href="testdb/{{$test->id}}"->{{$test->title}}</a></h3><br>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                            <a href="testdb/{{$test->id}}/edit" class="btn btn-primary btn-block"><i class="fas fa-edit"></i></a></div>
                                            <div class="col-md-6">
                                                {!! Form::open(['action' => ['TestdbController@destroy', $test->id], 'method' => 'POST', 'onsubmit' => 'return confirm("are you sure ?")']) !!}
                                                        {{Form::hidden('_method', 'DELETE')}}
                                                        {!! Form::button('<i class="fas fa-trash-alt"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-block')) !!}
                                                    {!! Form::close() !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            @endforeach
                        </div>
                    </div>
                        @else
                         <div class="row justify-content-center">
                        <p>You have no Records</p></div>
                    @endif
@endsection
