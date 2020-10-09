<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\tag;
use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function index(){
        $search = request()->query('search');
        if($search){
            $posts = Post::where('title' , 'LIKE', "%{$search}%")->simplePaginate(1);
        }else{
            $posts = Post::simplePaginate(2);
        }
        return view('welcome')
            ->with('posts' , $posts)
            ->with('categories', Category::all())
            ->with('tags' , tag::all());
    }
}

