<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ControlPanelController extends Controller
{
    public function __invoke(): View|Factory
    {
        return $this->view('index');
    }

    public function security(): View|Factory
    {
        return $this->view('security');
    }

    public function users(): View|Factory
    {
        return $this->view('users');
    }

    public function users_edit(int $user): View|Factory
    {
        return $this->view('users.edit', ['user' => $user]);
    }

    public function employees(): View|Factory
    {
        return $this->view('employees');
    }

    public function employees_create(): View|Factory
    {
        return $this->view('employees.create');
    }

    public function roles(): View|Factory
    {
        return $this->view('roles');
    }

    public function roles_edit(int $role): View|Factory
    {
        return $this->view('roles.edit', ['role' => $role]);
    }

    public function permissions(): View|Factory
    {
        return $this->view('permissions');
    }

    public function info(): View|Factory
    {
        return $this->view('info');
    }

    public function log(): View|Factory
    {
        return $this->view('log');
    }

    /**
     * Convenience function to return the subcategory view for the control
     * panel, when given the name of the subcategory.
     *
     * @param  string  $name The name of the panel
     * @param  Arrayable|array  $data
     * @return View|Factory The view corresponding to the panel name
     */
    public function view(string $name, $data = []): View|Factory
    {
        return view('control-panel.'.$name, $data);
    }
}
