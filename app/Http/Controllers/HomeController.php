<?php

namespace App\Http\Controllers;

use \App\department;
use \App\category;
use \App\User;
use App\Leave;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $leaves = Leave::all();
        $departments = Department::all();
        $categories = Category::all();
        $users = User::all();
        return view('dashboard', compact('leaves', 'departments', 'categories', 'users'));
    }
}
