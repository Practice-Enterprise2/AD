<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View|Factory
    {
        return view('control-panel.permissions.edit', ['permission' => Permission::query()->findOrFail($id)]);
    }
}
