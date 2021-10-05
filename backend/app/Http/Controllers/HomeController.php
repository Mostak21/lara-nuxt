<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;

class HomeController extends Controller
{
    public function category_page($id){
        $post=post::with('author')->where('category',$id)->get();
        return $post;

    }
}
