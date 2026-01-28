<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'id_role' => 'required'
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'id_role' => $request->id_role
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user){
        $request->validate([
            'username' => 'required',
            'id_role' => 'required'
        ]);

        $user->update([
            'username' => $request->username,
            'id_role' => $request->id_role
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('users.index');
    }
}
