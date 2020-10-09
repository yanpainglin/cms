<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\categories\createCategoryRequest;
use App\Http\Requests\categories\updateCategoryRequest;


class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $category = Category::all();

        return view('categories.index',[
            'category'=>$category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createCategoryRequest $request)
    {


        $data = $request->all();
        $category = new Category();

        $category->name =  $data['name'];
        $category->save();

        session()->flash('success', '"'.$category->name.'"'." Category was succefully created!!");

        return redirect('categories');

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
    public function edit(Category $category)
    {
        return view('categories.create',[
            'category'=>$category
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateCategoryRequest $request ,Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);



        session()->flash('success', 'Category name is updated to '.$category->name);

        return redirect(route('categories.index'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category ->delete();
        session()->flash('success' , "$category->name was deleted successfully!!");
        return redirect(route('categories.index'));
    }
}
