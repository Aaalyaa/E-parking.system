<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.pengaturan_pengguna.roles.index', compact('roles'));
    }

    public function create(){
        return view('admin.pengaturan_pengguna.roles.create');
    }

    public function store(Request $request){
        $request->validate([
            'peran' => 'required|unique:role'
        ]);

        Role::create([
            'peran' => $request->peran
        ]);

        return redirect()->route('admin.pengaturan_pengguna.roles.index');
    }

    public function edit(Role $role)
    {
        return view('admin.pengaturan_pengguna.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role){
        $request->validate([
            'peran' => 'required'
        ]);

        $role->update([
            'peran' => $request->peran
        ]);

        return redirect()->route('admin.pengaturan_pengguna.roles.index');
    }

    public function destroy(Role $role){
        $role->delete();
        return redirect()->route('admin.pengaturan_pengguna.roles.index');
    }
}
