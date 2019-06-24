<?php

namespace App\Http\Controllers;

use App\User;
use App\category;
use App\department;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        //$this->authorize('view', User::class);

        if(auth()->id() == 1)
        {
            $users = User::with(['department', 'category'])->get();
            return view('users.index', ['users' => $model->paginate(15)] );
        }
        return back();


    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
       // $this->authorize('edit', User::class);

       if(auth()->id() == 1)
       {
            $categories = Category::all();
            $departments = Department::all();
            return view('users.edit', compact('user', 'categories', 'departments'));
       }
       return back();
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        //$this->authorize('update', User::class);

        if(auth()->id() == 1)
        {
            if(!$request->get('password') == null)
            {
                $user->update(
                    $request->merge(['password' => Hash::make($request->get('password'))])
                        ->except([$request->get('password') ? '' : 'password', 'password_confirmation']          
                ));
            }   
            else
            { 
                $data = $request->validate([
                    'name' => 'required|max:50',
                    'email' => 'required|max:50|unique:users,id',
                    'username' => 'required|unique:users,id',
                    'staff_id' => 'required|unique:users,id|numeric',
                    'category_id' => 'sometimes',
                    'permission' => 'sometimes',
                    'department_id' => 'required'
                ]);
                
                //dd($data);
                $user->update($data);
            }   
            return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
        }

        return back();
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        if(auth()->id() == 1)
        {
            $user->delete();

            return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
        }
        
        return back();


    }
}
