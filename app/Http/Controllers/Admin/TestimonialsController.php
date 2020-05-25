<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();

        return view('adminn.testimonial.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminn.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $testimonials = new Testimonial();
        $testimonials->description = $request->input('description');
         if ($request->file('image')) {
            $file = $request->file('image');    
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename= time() . '.' . $extension;
            $file ->move('public/frontend/images/',$filename);
            $testimonials->image =$filename;
        } else {
            return   $request;
            $testimonials ->image ='image';
        } 

        $testimonials->name= $request->input('name');

        $testimonials->save();

        return redirect()->route('adminn.testimonial.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $testimonials = Testimonial::findOrFail($id);
        return view('adminn.testimonial.edit',compact('testimonials'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
         $request->validate([
            'description'=>'required',
            'image'=>'required',
            'name'=>'required' 
          
        ]);

         $testimonials=Testimonial::findOrFail($id);
         $testimonials->description = $request->input('description');
         if ($request->file('image')) {
            $file = $request->file('image');    
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename= time() . '.' . $extension;
            $file ->move('public/frontend/images/',$filename);
            $testimonials->image =$filename;
        }  

        $testimonials->name= $request->input('name');

        $testimonials->save();

        return redirect()->route('adminn.testimonial.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $testimonials = Testimonial::findOrFail($id);
        $testimonials->delete();

        return redirect()->route('adminn.testimonial.index');
    }
}
