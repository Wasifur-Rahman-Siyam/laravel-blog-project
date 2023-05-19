<?php

namespace App\Http\Controllers\Backend\User;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    function index() 
    {
        return view('backend.user.profile.index');
    }

    function updateProfile(Request $request) 
    {
        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name'      => 'required|string|max:255|min:2',
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'image'     => 'image| mimes:jpg,png,jpeg,svg'
        ]);
        $user->name = $request->name;
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

    function updatePassword(Request $request) 
    {
        $request->validate([
            'old_password'      => 'required',
            'password'          => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password, $hashedPassword)){
            if(!Hash::check($request->password, $hashedPassword)){
                $user = User::Find(Auth::id());
                $user->password  = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('msg','password updated successfully');
                Auth::logout();
                return redirect()->back();
            }
            else{
                return redirect()->back()->with('msg','New password cannot be same as old password');
            }
        }
        else{
            return redirect()->back()->with('msg','Current password not matched with old');
        }
    }
}
