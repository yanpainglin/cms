<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Post;
use App\tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCC')->only('create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('category', Category::all())->with('tag', tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $image = $request->image->store('posts');

       $post = Post::create([
           'title' => $request->title,
           'description' => $request->description,
           'content' => $request->cont,
            'image' => $image,
            'publish_at'=>$request->publish_at,
            'category_id' =>$request->category_id
        ]);

       if($request->tags){
           $post->tags()->attach($request->tags);
       }

        session()->flash('success', "$request->title was successfully created!!");

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {


        return view('posts.create', [
            'posts'=>$post,
            'category'=>Category::all(),
            'tag' =>tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        if($request->hasFile('image')){
           $image =  $request->image->store('posts');
            $post->deleteImage();

            $post->image = $image;
        }

        $post->update([
            'title' => $request->title,
            'description'=>$request->description,
            'content'=>$request->cont,
            'publish_at'=>$request->publish_at,
            'category_id' => $request->category_id
        ]);

        if($request->tags){
            $post->tags()->sync($request->tags);
        }



        session()->flash('success', "$post->title was updated successfully");

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::withTrashed($id)->where('id', $id)->first();
        if($post->trashed()){
            $post->forceDelete();
            $post->deleteImage();
        }else{
            $post->delete();
        }

        session()->flash('success', "$post->title was deleted successfully!");
        return back();
    }
    /**
     * View all the trashed posts
     *

     * @return \Illuminate\Http\Response
     */
    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id' , $id)->findOrFail($id);

        $post->restore();

        session()->flash('success', "$post->title was successfully restored!!");

        return redirect()->back();
    }
}
