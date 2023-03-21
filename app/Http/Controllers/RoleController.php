<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function show(){
        $data = Role::all();
        return view('admin.roles', ['roles'=>$data]);
    }

    public function update(Request $request, $id){
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        return response()->json(['name' => $role->name]);
    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully!');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $newId = Role::max('id') + 1;
    
        $role = new Role;
        $role->id = $newId;
        $role->name = $data['name'];
        $role->save();
    
    
        return redirect()->back()->with('success', 'Role added successfully.');
    }
}
