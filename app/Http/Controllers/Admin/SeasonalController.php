<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Seasonal;

class SeasonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasonals =Seasonal::all();

        return view('adminn.season.index', compact('seasonals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminn.season.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $seasonals = Seasonal::create(array_merge($request->all()));
        if ($request->hasFile('image') || $request->hasFile('title_deed')) {
            $file = $request->file('image');
            $file1 = $request->file('title_deed');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $fileName1 = time() . '.' . $file1->getClientOriginalExtension();
            $request->image->move('frontend/images/', $fileName);
            $request->gtitle_deed->move('frontend/images/', $fileName1);
            
            $seasonals->update([
                'image' => $fileName,
                'title_deed' => $fileName1,
               
            ]);
           
            $request->input('heading');
            $request->input('description');
            $request->input('email');
            $request->input('phone');
            
        }

         
        
        $seasonals->save();
        return redirect()->route("adminn.season.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
