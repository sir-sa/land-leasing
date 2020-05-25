<?php

namespace App\Http\Controllers\Admin;

use App\Blogs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs =Blogs::all();
        return view('adminn.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminn.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $blogs = new Blogs();
        if ($request->file('image')) {
            $file = $request->file('image');    
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename= time() . '.' . $extension;
            $file ->move('public/frontend/images/',$filename);
            $blogs->image =$filename;
        } else {
            return   $request;
            $blogs ->image ='image';
        } 

        $blogs->heading=$request->input('heading');
        $blogs->description=$request->input('description');
        $blogs->save();

        return redirect()->route('adminn.blog.index');

         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogs = Blogs::findOrFail($id);

        return view('adminn.blog.edit', compact('blogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           $request->validate([
            'image'=>'required',
            'heading'=>'required',
            'description'=>'required' 
          
        ]);

         $blogs = Blogs::findOrFail($id);
        if ($request->file('image')) {
            $file = $request->file('image');    
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename= time() . '.' . $extension;
            $file ->move('public/frontend/images/',$filename);
            $blogs->image =$filename;
        }

        $blogs->heading=$request->input('heading');
        $blogs->description=$request->input('description');
        $blogs->save();

        return redirect()->route('adminn.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $blogs = Blogs::findOrFail($id);
        $blogs->delete();
        return redirect()->route('adminn.blog.index');
    }
}
