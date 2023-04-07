<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function show()
    {
        $users = User::with('roles')->get();
        $roles = Role::pluck('name')->unique();

        return view('admin.users', ['users' => $users, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $role = Role::where('name', $request->role)->first();
        $user->roles()->sync([$role->id]);

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role->name,
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // HACK: This solves the fact that the `unique` validation rule doesn't
        // take soft deletion into account.
        if (! User::where('email', $request->email)->get()->first()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // TODO: Enable this once the mail server is up and running.
            /* event(new Registered($user)); */

            $user->roles()->attach(Role::where('name', 'user')->first());

            return redirect()->back()->with('success', 'User created successfully!');
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\Users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }
    }

    // locke or unlock account
    public function toggleLock(User $user)
    {
        $user->is_locked = ! $user->is_locked;
        $user->save();

        return redirect()->back();
    }
}
