<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts =Posts::all();
        return view('adminn.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminn.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $posts = new Posts();
        if ($request->file('image')) {
            $file = $request->file('image');    
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename= time() . '.' . $extension;
            $file ->move('public/frontend/images/',$filename);
            $posts->image =$filename;
        } else {
            return   $request;
            $posts ->image ='image';
        } 
        
        $posts->name=$request->input('name');
        $posts->cash=$request->input('cash');
        $posts->description=$request->input('description');
        $posts->email=$request->input('email');
        $posts->phone=$request->input('phone');
        $posts->amenity=implode(",", $request->amenity);
        $posts->utility=implode(",", $request->utility);
        // $checkbox = implode(",", $request->amenity);
        // $checkbox = implode(",", $request->utility);
        // $posts->amenity = $checkbox; 
        // $posts->utility = $checkbox; 
        
        
        $posts->save();
        return redirect()->route("adminn.posts.index");
    }



    // if ($request->hasFile('image')) {
    //         // Get file with extension
    //         $filenameWithExt = $request->file('image')->getClientOriginalName();
    //         // $filenameWithExt = $request->file('title_deed')->getClientOriginalName();

    //          // just get filename
    //         $filename =pathinfo($filenameWithExt,PATHINFO_FILENAME);
    //         // $filename1 =pathinfo($filenameWithExt,PATHINFO_FILENAME);

    //          // get just extension
    //         $extension = $request->file('image')->getClientOriginalExtension();
    //         // $extension = $request->file('title_deed')->getClientOriginalExtension();

    //         // filename to store
    //         $fileNameToStore = $filename.'_'.time().'.'.$extension;
    //         // $fileNameToStore = $filename1.'_'.time().'.'.$extension;

    //         // upload the image
    //         $path = $request->file('image')->storeAs('frontend/images/',$fileNameToStore);
    //         // $path = $request->file('title_deed')->storeAs('frontend/images/',$fileNameToStore);

            
            
    //     } else {

    //        $fileNameToStore ="noimage.jpg";

    //     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts =Posts::findOrFail($id);

        return view('adminn.posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Posts::findOrFail($id);

        return view('adminn.posts.edit',compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'image'=>'required',
            'title_deed'=>'required',
            'heading'=>'required',
            'description'=>'required',
            'email'=>'required',
            'phone'=>'required', 
            'amenity'=>'required', 
            'utility'=>'required' 
             

        ]);

        $posts = Posts::find($id);
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename= time() . '.' . $extension;
            $file ->move('public/frontend/images/',$filename);
            $posts->image =$filename;
        }
        else {
            return   $request;
            $posts ->image ='image';
        } 
         if ($request->file('title_deed')) {
            $file = $request->file('title_deed');    
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename= time() . '.' . $extension;
            $file ->move('public/frontend/images/',$filename);
            $posts->title_deed =$filename;
        }
        else {
            return   $request;
            $posts ->title_deed ='title_deed';
        }

        $posts->name = $request->input('name');
        $posts->cash = $request->input('cash');
        $posts->description = $request->input('description');
        $posts->email = $request->input('email');
        $posts->phone = $request->input('phone');
        $posts->amenity=$request->amenity;
        $posts->utility=$request->utility;
         


        $posts->save(); //persist the data
        return redirect()->route('adminn.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Posts::findOrFail($id);
        $posts->delete();
        return redirect()->route('adminn.posts.index');
    }
}
