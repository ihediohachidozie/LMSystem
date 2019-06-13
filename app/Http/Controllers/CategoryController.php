<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth')->except(['index']); // locking part of a controller
        $this->middleware('auth'); // locking all parts
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->id() == 1)
        {
            $categories = Category::all();
            return view('category.index', compact('categories') );
        }
        return back();


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  $this->authorize('create', Category::class);
        if(auth()->id() == 1)
        {
            $category = new Category();
            return view('category.create', compact('category'));
        }
        return back();
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  $this->authorize('create', Category::class);

        if(auth()->id() == 1)
        {
            $data = request()->validate([
                'category' => 'required',
                'days' => 'required|max:30|min:1',
            ]);
            $category = Category::create($data);
    
            return redirect('category')->withStatus(__('Category successfully saved.'));
        }
        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
    //    $this->authorize('edit', Category::class);
        if(auth()->id() == 1)
        {
            return view('category.edit', compact('category'));
        }
        return back();
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
       // $this->authorize('update', Category::class);

        if(auth()->id() == 1)
        {
            $data = request()->validate([
                'category' => 'required',
                'days' => 'required',
            ]);
            $category->update($data);
    
            return redirect('category')->withStatus(__('Category successfully updated.'));
        }
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
       // $this->authorize('delete', Category::class);

       if(auth()->id() == 1)
       {
            $category->delete();

            return redirect('category')->withStatus(__('Category successfully deleted.'));
       }
       return back();

    }
}
