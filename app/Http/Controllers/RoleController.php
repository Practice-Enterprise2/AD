<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function create(): View
    {
        return view('control-panel.roles.create');
    }

    public function index(): View
    {
        $data = Role::all();

        return view('admin.roles', ['roles' => $data]);
    }

    /**
     * @param  mixed  $id The id of the role to update
     */
    public function update(Request $request, $id): JsonResponse
    {
        $role = Role::query()->find($id);
        $role->name = $request->input('name');
        $role->save();

        return response()->json(['name' => $role->name]);
    }

    /**
     * @param  mixed  $id The id of the role to delete
     */
    public function destroy($id): RedirectResponse
    {
        $role = Role::query()->findOrFail($id);
        $role_name = $role->name;

        // Get the users with the deleted role
        $users_with_role = User::query()->whereHas(
            'roles', function ($query) {
                $query->where('name', $role_name);
            }
        )->get();

        // Reassign the users to the "user" role
        foreach ($users_with_role as $user) {
            $user->removeRole($role_name);
            if ($user->roles->isEmpty()) {
                // Every user deserves a role I guess...
                // I'm just translating code, I don't make the rules :p
                $user->assignRole('user');
            }
        }

        // Delete the role
        $role->delete();

        return redirect()->back()->with('success', 'Role deleted successfully!');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $newId = Role::query()->max('id') + 1;

        $role = new Role();
        $role->id = $newId;
        $role->name = $data['name'];
        $role->save();

        return redirect()->back()->with('success', 'Role added successfully.');
    }
}
