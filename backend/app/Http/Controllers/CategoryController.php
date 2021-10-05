<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(category::all()
            );
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
        $category=new category();
        $category->name=$request->name;
        if($request->hasfile('image'))
        {
            $image1name =uniqid().$request->file('image')->getClientOriginalName();
            $image1=$request->file('image');
            $image1->storeAs('thumbnails',$image1name) ;
            $category->image="thumbnails/".$image1name ;
        }
        $category->slag=$request->slag;
        $category->state=$request->state;

        $category->save();

        return "Category Add succesfully";
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)

    {

        $category->subcategory;
        $category->post;

        return response()->json(
            $category
        );

       // return $category->subcategory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return $category;
        
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $category->name=$request->name;
        $category->slag=$request->slag;
        $category->state=$request->state;
        $category->save();

        return " Category Updated Succesfully!";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
       $category->delete();
       return" Deleted succesfully";
    }
}
