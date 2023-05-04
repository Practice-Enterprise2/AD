<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Contracts\View\View;

class PermissionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        return view('control-panel.permissions.edit', ['permission' => Permission::query()->findOrFail($id)]);
    }
}
