<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class ControlPanelController extends Controller
{
    public function users(): View|Factory
    {
        Log::debug(str_starts_with(request()->route()->getName(), 'control-panel'));

        return $this->view('users');
    }

    public function info(): View|Factory
    {
        return $this->view('info');
    }

    /**
     * Convenience function to return the subcategory view for the control
     * panel, when given the name of the subcategory.
     *
     * @param  string  $name The name of the panel
     * @return View|Factory The view corresponding to the panel name
     */
    public function view(string $name): View|Factory
    {
        return view('control-panel.'.$name);
    }
}
