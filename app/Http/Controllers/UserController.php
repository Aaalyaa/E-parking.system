<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Helpers\LogAktivitas;

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

        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'id_role' => $request->id_role
        ]);

        LogAktivitas::add(
            'CREATE_USER',
            'Menambahkan pengguna baru: Username ' . $request->username . ', Role ID ' . $request->id_role,
            'users',
            $user->id,
            null,
            null,
            $user->toArray()
        );

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

        $before = $user->getOriginal();

        $user->update([
            'username' => $request->username,
            'id_role' => $request->id_role
        ]);

        $after = $user->fresh()->toArray();

        LogAktivitas::add(
            'UPDATE_USER',
            'Memperbarui pengguna: ID ' . $user->id . ', Username ' . $request->username . ', Role ID ' . $request->id_role,
            'users',
            $user->id,
            null,
            $before,
            $after
        );

        return redirect()->route('users.index');
    }

    public function destroy(User $user){

        $before = $user->toArray();

        $user->delete();

        LogAktivitas::add(
            'DELETE_USER',
            'Menghapus pengguna: ID ' . $user->id . ', Username ' . $user->username,
            'users',
            $user->id,
            null,
            $before,
            null
        );

        return redirect()->route('users.index');
    }
}
