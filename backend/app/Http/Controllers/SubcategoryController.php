<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return subcategory::with('category')->get();
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
        $category=new subcategory();
        $category->name=$request->name;
        $category->cat_id=$request->cat_id;
        $category->slag=$request->slag;
        $category->state=$request->state;
        $category->save();

        return "sub Category Add succesfully";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(subcategory $subcategory)
    {
        $subcategory->category;
        $subcategory->post;
        

        return response()->json(
            $subcategory
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(subcategory $subcategory)
    {
        return $subcategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subcategory $subcategory)
    {
        $subcategory->name=$request->name;
        $subcategory->cat_id=$request->cat_id;
        $subcategory->slag=$request->slag;
        $subcategory->state=$request->state;
        $subcategory->save();
        return" Sub Cat Updated succesfully";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(subcategory $subcategory)
    {
        $subcategory->delete();
       return" Sub Cat Deleted succesfully";
    }
}
