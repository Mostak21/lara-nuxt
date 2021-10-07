<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return post::all();
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
        $post=new Post;
        $post->title=$request->title;
        $post->category=$request->category;
        $post->subcategory=$request->subcategory ;
        $post->content=$request->content;

        if($request->hasfile('thumbnail'))
        {
            $image1name =uniqid().$request->file('thumbnail')->getClientOriginalName();
            $image1=$request->file('thumbnail');
            $image1->storeAs('thumbnails',$image1name);
            $post->thumbnail="thumbnails/".$image1name;
        }
 
        $post->state=$request->state ;
        $post->slag=$request->slag ;
        $post->user_id="1";
        $post->save();
        return " succesfully saved ";

       


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    

    public function show(post $post)
    {
        $post->author;
        $post->cat;
        $post->subcat;
        $post->comment;

        return response()->json(
            $post
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        
        $post->title=$request->title ;
        $post->category=$request->category;
        $post->subcategory=$request->subcategory ;
        $post->content=$request->content;

        if($request->hasfile('thumbnail'))
        {
            $image1name =uniqid().$request->file('thumbnail')->getClientOriginalName();
            $image1=$request->file('thumbnail');
            $image1->storeAs('thumbnails',$image1name);
            $post->thumbnail="thumbnails/".$image1name;
        }
        
        
        
        $post->state=$request->state ;
        $post->slag=$request->slag ;
        $post->user_id="1";
        $post->save();
        
        return "Update succesfully";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
