@extends('layouts.app')

@section('content')
<div class="container">
    <a style="margin-left: 880px;" href="actor/create"> <span class="badge"><h3>Create New Actor <i class="fas fa-plus"></i></h3></span></a><br>
</div>
    <div class="container">
        <div class="row">
    @if(count($actors) > 0)
        @foreach($actors as $actor)
                            <div class="col-md-4">
                                <div class="card bg-dark mb-3" style="width: 350px;box-shadow: 10px 10px 10px black;border-radius: 30px">
                                    <a href="actor/{{$actor->id}}"-><img style="width:350px;height:350px;object-fit: cover;border-radius: 30px" src="/storage/actor_images/{{$actor->actor_image}}"></a>
                                        <div class="card-body">
                                            <h3 align="center"> <a href="actor/{{$actor->id}}"->{{$actor->actorname}}</a></h3>
                                    </div></div><br></div>
                            @endforeach
                        </div></div>
    @else
    <div class="container">
    <div class="row justify-content-center">
        <p>Nothing found</p></div></div>
    @endif
@endsection