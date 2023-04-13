<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = ['search' => ['except' => '']];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View|Factory
    {
        return view('livewire.users', ['users' => User::query()->where('name', 'LIKE', "%$this->search%")->orWhere('last_name', 'LIKE', "%$this->search%")->paginate(10)]);
    }
}
