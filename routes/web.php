<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
Route::patch('profile', 'ProfileController@picture')->name('profile.picture');

// Department routes
//Route::resource('department', 'DepartmentController');
Route::get('department', 'DepartmentController@index')->name('department.index');
Route::get('department/create', 'DepartmentController@create')->name('department.create');
Route::post('department', 'DepartmentController@store')->name('department.store');
Route::get('department/{department}/edit', 'DepartmentController@edit')->name('department.edit');
Route::patch('department/{department}', 'DepartmentController@update')->name('department.update');
Route::delete('department/{department}', 'DepartmentController@destroy')->name('department.destroy');

// Categories routes
Route::resource('category', 'CategoryController');

// Leaves routes
//cls
Route::resource('leave', 'LeaveController');
Route::get('leave', 'LeaveController@index')->name('leave.index');
Route::get('leave/create', 'LeaveController@create')->name('leave.create');
Route::post('leave', 'LeaveController@store')->name('leave.store');
Route::get('leave/{leave}/edit', 'LeaveController@edit')->name('leave.edit');
Route::patch('leave/{leave}', 'LeaveController@update')->name('leave.update');
Route::get('leave.approval', 'LeaveController@approval')->name('leave.approval');
Route::get('leave.leaveSummary', 'LeaveController@leaveSummary')->name('leave.leaveSummary');
Route::put('leave/{leave}', 'LeaveController@approveleave')->name('leave.approveleave');
Route::get('leave.staffleaveentry', 'LeaveController@staffleaveentry')->name('staffleaveentry');


// get user individual leave entries and summary by admin

Route::get('leave.getUser', 'LeaveController@getUser')->name('leave.getUser');
Route::get('leave/staffhistory/{id}', 'LeaveController@staffhistory')->name('leave.staffhistory');
Route::get('leave/staffsummary/{id}', 'LeaveController@staffsummary')->name('leave.staffsummary');


// Public Holidays routes
Route::resource('publicholiday', 'PublicHolidayController');
