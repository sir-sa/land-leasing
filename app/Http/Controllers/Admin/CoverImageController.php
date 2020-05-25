<?php

namespace App\Http\Controllers\Admin;

use App\CoverImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoverImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = CoverImage::all();
        return view('adminn.coverimage.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function show(CoverImage $coverImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $images = CoverImage::findOrFail($id);
        return view('adminn.coverimage.edit',compact('images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
    {
         $request->validate([
           
            'image'=>'required'
            
          
        ]);

         $images=CoverImage::findOrFail($id);
        
         if ($request->file('image')) {
            $file = $request->file('image');    
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename= time() . '.' . $extension;
            $file ->move('public/frontend/images/',$filename);
            $images->image =$filename;
        } 

        $images->save();

        return redirect()->route('adminn.coverimage.index');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoverImage $coverImage)
    {
        //
    }
}
