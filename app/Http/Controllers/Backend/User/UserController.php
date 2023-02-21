<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\UploadHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!request()->user()->hasPermissionTo('user.create')){
            abort(401);
        }
        return view('backend.users.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255|min:2',
            'username'  => 'required|string|unique:users|alpha_num|max:20|min:2',
            'email'     => 'required|email|unique:users',
            'password'  => 'required',
            'image'     => 'image| mimes:jpg,png,jpeg,svg'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->status = 'Active';
        $user->password = Hash::make($request->password);
        $user->assignRole('user');
        $user->save();
        if($request->image){
            $imageName = UploadHelper::upload($request->image, 'user-'.$user->id, 'images/users');
            $user->image = 'images/users/'.$imageName;
            $user->save();
        }
        return redirect()->back()->with('msg', 'User Added Successfully');
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
    public function edit($id)
    {
        if(request()->user()->id != $id){
            abort(401);
        }
        $user = User::find($id);
        if(!is_null($user)){
            return view('backend.users.edit',compact('user'));
        }
        return redirect()->back()->with('msg', 'User not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $user = User::find($id);
        if(!is_null($user)){
            $request->validate([
                'name'      => 'required|string|max:255|min:2',
                'username'  => 'required|string|alpha_num|max:20|unique:users,username,'.$user->id,
                'email'     => 'required|email|unique:users,email,'.$user->id,
                'image'     => 'image| mimes:jpg,png,jpeg,svg'
            ]);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->status = 'Active';
            $user->password = Hash::make($request->password);
            $user->save();
            if($request->image){
                $deleteImage = $user->image;
                if(File::exists($deleteImage)){
                   File::delete($deleteImage);
                }
                $imageName = UploadHelper::upload($request->image, 'user-'.$user->id, 'images/users');
                $user->image = 'images/users/'.$imageName;
                $user->save();
            }
            return redirect()->back()->with('msg', 'User Updated Successfully');
        }
        return redirect()->back()->with('msg', 'User not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!is_null($user)){
            $deleteImage = $user->image;
            $user->delete();
                if(File::exists($deleteImage)){
                   File::delete($deleteImage);
                }
                return redirect()->back()->with('msg', 'User Deleted successfully');
        }
        return redirect()->back()->with('msg', 'User not found');
    }
}
