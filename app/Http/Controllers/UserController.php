<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }
    public function updateRole(Request $request){
        $request->validate([
            'user_id' => 'required|exists:roles,id',
            'role_id' => 'required'
        ]); 

        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');

        $user = User::find($userId);
        $user->role_id = $roleId;
        $user->save();

        Alert::success('Berhasil', 'Role berhasil diubah');
        return redirect()->route('users.index');
    }
}
