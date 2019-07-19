<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Test;
use App\Actor;
use App\Comment;
use App\User;

class TestdbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $tests = Test::orderBy ('created_at', 'desc')->get();
        return view('index')->with('tests',$tests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $actors = Actor::all();
        return view('create')->with('actors',$actors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required', 
            'body' => 'required',
            'youtube' => 'required', 
            'cover_image' => 'image|max:1999'
        ]);

        if($request->hasFile('cover_image')){
            $fileNameToStore = $request->file('cover_image')->getClientOriginalName();
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 

        else {
            $fileNameToStore = 'noimage.jpg';
        }

        $db = new Test();
        $db -> title = $request->input('title');
        $db -> body = $request->input('body');
        $db -> youtube = $request->input('youtube');
        $db -> user_id = auth()->user()->id;
        $db -> username = auth()->user()->name;
        $db -> cover_image = $fileNameToStore;
        $db -> save();
        $db -> actors()->sync($request->actors);
            return redirect('home')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $db = Test::find($id);
        $comment = Comment::find($id);
        return view('show')->with('db', $db)->with('comment',$comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $db = Test::find($id);

        if(auth()->user()->id !== $db->user_id){

            return redirect('testdb')->with('error','Unauthorized Access');

        }

        $actors = Actor::all();
        $actors2 = array();
            foreach ($actors as $actor) {
                $actors2[$actor->id] = $actor->actorname;
        }

        return view('edit')->with('db', $db)->with('actors',$actors2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $fileNameToStore = $request->file('cover_image')->getClientOriginalName();
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 
        
        $db = Test::find($id);
        $db -> title = $request->input('title');
        $db -> body = $request->input('body');
        $db -> youtube =$request->input('youtube');
        if($request->hasFile('cover_image')) {

            $db -> cover_image = $fileNameToStore;    
        }
        $db -> save();
         $db -> actors()->sync($request->actors);
        return redirect('testdb/'.$id)->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $db= Test::find($id);
        if ($db->cover_image != 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$db->cover_image);
        }

        $db->delete();
        return redirect('home')->with('success','Deleted Successfully');

        $comment= Comment::find($id);
        $comment->delete();
        return back()->with('success', 'Comment Deleted Successfully');
    }

}