@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <h1>{{$db->title}}</h1> </div> </div> </div>
<br>
<br>
<div class="container" style="margin-top: -30px">
    <div class="row">
    <div class="col-md-6">
    <img style="height: 300px; box-shadow: 10px 10px 10px black;border-radius: 30px" src="/storage/cover_images/{{$db->cover_image}}">
    
    </div>
    <div class="col-md-6"> 
        {!!$db->body!!}
        <hr>
    <strong>Created By: </strong>{{$db->username}} , Creation Date: {{$db->created_at->format('d/m/Y')}} </div> </div>
  <div class="row" style="margin-left: 10px">
    @if (Auth::user()->id == $db->user_id)
    <h2 class="btn btn-link"><a href="{{$db->id}}/edit"><i class="fas fa-edit"></i></a></h2>
    {!! Form::open(['action' => ['TestdbController@destroy', $db->id], 'method' => 'POST', 'onsubmit' => 'return confirm("are you sure ?")']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {!! Form::button('<i class="fas fa-trash-alt"></i>', array('type' => 'submit', 'class' => 'btn btn-link')) !!}
                {!! Form::close() !!}
                @endif
</div> </div> <hr>
    <div class="container">
      <div class="row">
              <div class="col-md-6">
        <strong>Staring: </strong>
        <br>
        <div class="list-group"> 
                @foreach ($db->actors as $actor)
                <div class="list-group-items">
                    <a href="/actor/{{$actor->id}}" class="btn btn-link" >{{ $actor->actorname }}</a>
                </div>
                @endforeach

            </div>
            </div>
            <div class="col-md-6"> 
        {!!$db->youtube!!}</div>

        </div>
    </div>
           <br> <hr>
    <div class="container" style="margin-top: -20px">
    <div class="display-comment">

                        <div class="container" style="margin-top: 15px"></div>
                        <div class="form-group">
                            <textarea style="background-color: #D3D3D3" placeholder="Enter Comment" class="form-control" name="body" id="body"></textarea>
                            <input type="hidden" id="test_id" value="{{ $db->id }}" />
                        </div>
                        <div class="form-group">
                            <button id="ajaxSubmit" type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                        </div>
                        <div id="123">
          @include('commentsDisplay', ['comments' => $db->comments])
     </div>
                </div>

</div>
            </div>

<script>           
            jQuery('#ajaxSubmit').click(function(e){

         jQuery(document).ready(function(){

               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('storecomments') }}",
                  method: 'POST',
                  data: {
                     body: jQuery('#body').val(),
                     test_id: jQuery('#test_id').val()

                  },
                  success: function(data){

                     $('#123').append('<br> <div id="removecard'+data.id+'" class="card" style="background-color: #2f2e2e; padding: 1%"><div id="11'+data.id+'" class="card-body" style="border-radius: 10px;padding:0.5%"><strong><b>{{Auth::user()->name}}:</b></strong><br>' + '<div class="dynamicbody'+data.id+'" ><p id="p-'+data.id+'" style="margin: 0.3%">' + data.body + '</p><a href="javascript:; "ref="'+ data.id +'" class="removedata"><i class="fas fa-trash"></i></a><a href="javascript:; "refer="'+ data.id +'" class="editcomment" style="margin-left:4px"><i class="fas fa-edit"></i></a></div></div></div>');
                     jQuery('#body').val("");
                  } });
               } );
            } );

          $(document).on('click', ".removedata", function () {
           var deleteIt = confirm('Are you sure?');
           if(deleteIt){
               var deletID = $(this).attr('ref');
               if(deletID)
               {

                 jQuery.ajax({
                  url: "{{ url('deletecomments') }}",
                  method: 'GET',
                  data: {
                    id:deletID
                  },
                  success: function(data){

                    $('#removecard'+deletID).remove();
                     
                  } 
                });
                       
               }
           }
       });


              $(document).on('click', ".editcomment", function () {
                  var editID = $(this).attr('refer');
                  var body = $('#p-'+editID).text();
                  if(editID)
                  {
                    alert("Edit Functionality Coming Soon!");

                    // $('.dynamicbody'+editID).hide();
                    // $('#removecard'+editID).append('<textarea id="edittext" class="form-control" style="background-color: #D3D3D3" name="body">'+body+'</textarea> <input id="editinput" type="hidden" value="'+editID+'" /><button type="button" id="editbutton" class="btn btn-link"><i class="fas fa-check"></i></button>');

                  }
                } );

              //      $(document).on('click', "#editbutton", function(){        
              //       var yoo=$("#edittext").val();
              //       var yooo=$("#editinput").val();
              //        $.ajaxSetup({
              //     headers: {
              //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              //     }
              // } );
              //  jQuery.ajax( {
              //     url: "{{ url('updatecomments') }}",
              //     method: 'POST',
              //     data: {
              //        body: yoo,
              //        id: yooo,
              //        test_id: jQuery('#test_id').val()

              //     },
              //     success: function(data){
              //       $('#edittext').hide();
              //       $('#editinput'+data.id).hide();
              //       $('#editbutton').hide();
              //       $('#removecard'+data.id).append('<div id="removecard'+data.id+'" style="background-color: #2f2e2e"  class="card"><div id="11'+data.id+'" class="card-body" style="padding: 0px; margin-left: 7px"><div class="dynamicbody'+data.id+'"><p id="p-'+data.id+'" style="margin: 0.3%">' + data.body + '</p><a href="javascript:; "ref="'+ data.id +'" class="removedata"><i class="fas fa-trash"></i></a><a href="javascript:; "refer="'+ data.id +'" class="editcomment" style="margin-left:4px"><i class="fas fa-edit"></i></a></div></div></div>');
              //        } 
              //      });
              // });
      </script>
@endsection