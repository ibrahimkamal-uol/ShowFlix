<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Actor;
use App\Test;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        
        $actors = Actor::orderBy ('created_at', 'desc')->get();
        return view('actorindex')->with('actors',$actors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createactor');
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

            'actorname' => 'required', 
            'actorbio' => 'required', 
            'actor_image' => 'image|max:1999'
        ]);

        if($request->hasFile('actor_image')){
            $fileNameToStore = $request->file('actor_image')->getClientOriginalName();
            $path = $request->file('actor_image')->storeAs('public/actor_images', $fileNameToStore);
        } 

        else {
            $fileNameToStore = 'noimage.jpg';
        }

        $actors = new Actor();
        $actors -> actorname = $request->input('actorname');
        $actors -> actorbio = $request->input('actorbio');
        $actors -> actor_image = $fileNameToStore;
        $actors -> user_id = auth()->user()->id;
        $actors -> save();
        return redirect('actor')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actors = Actor::find($id);
        $tests = Test::find($id);

        return view('actorshow')->with('actors', $actors)->with('tests', $tests);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actors = Actor::find($id);

        if(auth()->user()->id !== $actors->user_id){

            return redirect('actorindex')->with('error','Unauthorized Access');

        }

        return view('actoredit')->with('actors', $actors);
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
        if($request->hasFile('actor_image')){
            // Get filename with the extension
            $fileNameToStore = $request->file('actor_image')->getClientOriginalName();
            // Upload Image
            $path = $request->file('actor_image')->storeAs('public/actor_images', $fileNameToStore);
        } 
        
        $actors = Actor::find($id);
        $actors -> actorname = $request->input('actorname');
        $actors -> actorbio = $request->input('actorbio');
        if($request->hasFile('actor_image')) {

            $actors -> actor_image = $fileNameToStore;    
        }
        $actors -> save();
        return redirect('actor/'.$id)->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actors= Actor::find($id);
        if ($actors->actor_image != 'noimage.jpg') {
            Storage::delete('public/actor_images/'.$actors->actor_image);
        }

        $actors->delete();
        return redirect('actor')->with('success','Deleted Successfully');
    }
}