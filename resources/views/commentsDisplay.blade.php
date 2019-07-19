@foreach($comments as $comment)
<br><div id="removecard{{$comment->id}}" class="card" style="background-color: #2f2e2e; padding: 1%">
    <div id ="11{{$comment->id}}" class="card-body" style="border-radius: 10px;padding:0.5%">
        <strong><b>{{Auth::user()->name}}:</b></strong><br>
        <div class="dynamicbody{{$comment->id}}">
            <p id="p-{{$comment->id}}" style="margin: 0.3%">{{$comment->body}}</p>
            <a href="javascript:; "ref="{{$comment->id}}" class="removedata"><i class="fas fa-trash"></i></a>
            <a href="javascript:; "refer="{{$comment->id}}" class="editcomment"><i class="fas fa-edit"></i></a>
        </div> </div> </div>
@endforeach