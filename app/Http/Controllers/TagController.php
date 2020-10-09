<?php

namespace App\Http\Controllers;

use App\tag;

use Illuminate\Http\Request;
use App\Http\Requests\createtagRequest;
use App\Http\Requests\updatetagRequest;


class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $tag = Tag::all();

        return view('tags.index',[
            'tag'=>$tag
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createtagRequest $request)
    {


        $data = $request->all();
        $tag = new tag();

        $tag->name =  $data['name'];
        $tag->save();

        session()->flash('success', '"'.$tag->name.'"'." tag was successfully created!!");

        return redirect(route('tags.index'));

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
    public function edit(tag $tag)
    {
        return view('tags.create',[
            'tag'=>$tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updatetagRequest $request ,tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);



        session()->flash('success', 'tag name is updated to '.$tag->name);

        return redirect(route('tags.index'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(tag $tag)
    {
        $tag ->delete();
        session()->flash('success' , "$tag->name was deleted successfully!!");
        return redirect(route('tags.index'));
    }
}
