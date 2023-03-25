<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSettingsController extends Controller
{
    function index() {
        return view('backend.admin.profile.index');
    }

    function updateProfile(Request $request) {

        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name'      => 'required|string|max:255|min:2',
            'username'  => 'required|string|alpha_num|max:20|unique:users,username,'.$user->id,
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'image'     => 'image| mimes:jpg,png,jpeg,svg'
        ]);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        if($request->image){
            $image = $request->image;
            $deleteImage = $user->image;
            if(File::exists($deleteImage)){
               File::delete($deleteImage);
            }
            $extension = $image->getClientOriginalExtension();
            $fileName = 'user-'.$user->id . '.'.$extension;
            $image->move('images/users', $fileName);
            $user->image = 'images/users/'.$fileName;
            $user->save();
        }
        return redirect()->back()->with('msg', 'User Updated Successfully');
    }

}
