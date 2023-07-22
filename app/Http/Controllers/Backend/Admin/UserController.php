<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $adminRole = Role::where('name', 'user')->first();
        $users = User::role($adminRole)
        ->withCount('posts')
        ->get();
        return view('backend.admin.users.index', compact('users'));
    }



    public function assignAdminRole(Request $request, User $user)
    {
        $adminRole = Role::where('name', 'admin')->first();
        $user->syncRoles([$adminRole]);

        return redirect()->back()->with('msg', 'Admin Role reassigned successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user ->delete();
        return redirect()->back()->with('msg', 'User Deleted Successfully');
    }
}
