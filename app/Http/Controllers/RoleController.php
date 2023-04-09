<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function show()
    {
        $data = Role::all();

        return view('admin.roles', ['roles' => $data]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        return response()->json(['name' => $role->name]);
    }

    // Delete the role with the given id.
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role_name = $role->name;

        // Get the users with the deleted role
        $users_with_role = User::role($name)->get();

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $newId = Role::max('id') + 1;

        $role = new Role();
        $role->id = $newId;
        $role->name = $data['name'];
        $role->save();

        return redirect()->back()->with('success', 'Role added successfully.');
    }
}
