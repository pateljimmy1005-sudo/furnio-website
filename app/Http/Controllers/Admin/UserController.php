<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function adminUsers(Request $request)
    {
        $search = $request->search;

        $users = User::where('name', 'LIKE', "%$search%")
            ->latest()
            ->paginate(5);

        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User Deleted');
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'blocked';
        $user->save();

        return redirect()->back()->with('success', 'User Blocked Successfully');
    }

    public function unblockUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active'; 
        $user->save();

        return redirect()->back()->with('success', 'User Unblocked Successfully');
    }

    public function changeRole($id)
    {
        $user = User::findOrFail($id);

        if($user->role == 'admin')
        {
            $user->role = 'user';
        }
        else
        {
            $user->role = 'admin';
        }

        $user->save();

        return redirect()->back()->with('success', 'Role Updated');
    }

    public function userProfile($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user-profile', compact('user'));
    }
}
