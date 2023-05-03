<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Return a view showing all users.
     */
    public function show(): View
    {
        $users = User::with('roles')->get();
        $roles = Role::all()->pluck('name');

        return view('admin.users', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * @param  mixed  $id
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = User::query()->findOrFail($id);

        $this->authorize('update', $user);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles([$request->role]);

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role->name,
        ]);
    }

    /**
     * @param  mixed  $id
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::query()->findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // HACK: This solves the fact that the `unique` validation rule doesn't
        // take soft deletion into account.
        if (! User::query()->where('email', $request->email)->first()) {
            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // TODO: Enable this once the mail server is up and running.
            /* event(new Registered($user)); */

            $user->assignRole('user');

            return redirect()->back()->with('success', 'User created successfully!');
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\Users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }
    }

    // Lock or unlock account
    public function toggleLock(User $user): RedirectResponse
    {
        $user->is_locked = ! $user->is_locked;
        $user->save();

        return redirect()->back();
    }
}
