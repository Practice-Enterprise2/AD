<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRoles;

use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class UserController extends Controller
{
    public function show(){
        $users = User::with('roles')->get();
        $roles = Role::pluck('name')->unique();
        return view('admin.users', ['users' => $users, 'roles' => $roles]);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $role = Role::where('name', $request->role)->first();
        $user->roles()->sync([$role->id]);
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role->name
        ]);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
    
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->roles()->attach(Role::where('name', 'user')->first());
        $user->save();
    
        return redirect()->back()->with('success', 'User added successfully.');
    }
}