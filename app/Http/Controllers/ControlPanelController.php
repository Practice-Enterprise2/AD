<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View;

class ControlPanelController extends Controller
{
    public function __invoke(): View
    {
        return $this->view('index');
    }

    public function security(): View
    {
        return $this->view('security');
    }

    public function users(): View
    {
        return $this->view('users');
    }

    public function users_edit(int $user): View
    {
        return $this->view('users.edit', ['user' => $user]);
    }

    public function employees(): View
    {
        return $this->view('employees');
    }

    public function employees_create(): View
    {
        return $this->view('employees.create');
    }

    public function roles(): View
    {
        return $this->view('roles');
    }

    public function roles_edit(int $role): View
    {
        return $this->view('roles.edit', ['role' => $role]);
    }

    public function permissions(): View
    {
        return $this->view('permissions');
    }

    public function info(): View
    {
        return $this->view('info');
    }

    public function log(): View
    {
        return $this->view('log');
    }

    /**
     * Convenience function to return the subcategory view for the control
     * panel, when given the name of the subcategory.
     *
     * @param  string  $name The name of the panel
     * @param  Arrayable|array  $data
     * @return View The view corresponding to the panel name
     */
    public function view(string $name, $data = []): View
    {
        return view('control-panel.'.$name, $data);
    }
}
