<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
      //  $this->authorize('view', Department::class);

      if(auth()->id() == 1)
      {
          $departments = Department::all();
          
          return view('department.index', compact('departments'));
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
      //  $this->authorize('create', Department::class);
      if(auth()->id() == 1)
      {
          $department = new Department();
          
          return view('department.create', compact('department'));
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
       // $this->authorize('create', Department::class);

       if(auth()->id() == 1)
       {
            $data = request()->validate([
                'department' => 'required',
            ]);
            $department = Department::create($data);

        // return redirect('department');
            return redirect('department')->withStatus(__('Department successfully saved.'));
       }
       return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
      //  $this->authorize('edit', Department::class);

      if(auth()->id() == 1)
      {
            return view('department.edit', compact('department'));
      }
      return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Department $department)
    {
       // $this->authorize('update', $department);
       if(auth()->id() == 1)
       {
            $data = request()->validate([
                'department' => 'required',
            ]);
            $department->update($data);

            return redirect('department')->withStatus(__('Department successfully updated.'));
       }
       return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
      //  $this->authorize('delete', $department);

      if(auth()->id() == 1)
      {
            $department->delete();

            return redirect('department')->withStatus(__('Department successfully deleted.'));
      }
      return back();


    }
}
