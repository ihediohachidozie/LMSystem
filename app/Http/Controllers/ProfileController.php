<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\PictureRequest;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\User;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
       
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    /**
     * Upload profile image
     */
    public function picture(PictureRequest $request)
    {
         $data = request()->validate([
            'image' => 'sometimes|file|image|max:5000',
        ]); 
        auth()->user()->update($request->all());

        $this->storeImage();

        return back()->withStatus(__('Image uploaded successfully.'));
    }

    private function storeImage()
    {
        if(request()->has('image')){
            auth()->user()->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);

            $image = Image::make(public_path('storage/'. auth()->user()->image))->fit(300, 300);

            $image->save();
        }
    }
}
