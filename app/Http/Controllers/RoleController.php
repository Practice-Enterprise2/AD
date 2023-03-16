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
}
