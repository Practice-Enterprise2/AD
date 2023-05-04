<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public string $search = '';

    public null|string $sort_field = null;

    public bool $sort_ascending = true;

    protected $queryString = ['search' => ['except' => '']];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function sort_by(string $field): void
    {
        if ($this->sort_field === $field) {
            $this->sort_ascending = ! $this->sort_ascending;
        } else {
            $this->sort_field = $field;
            $this->sort_ascending = true;
        }
    }

    public function render(): View
    {
        $query = User::query()
            ->where('name', 'LIKE', "%$this->search%")
            ->orWhere('email', 'LIKE', "%$this->search%")
            ->orWhere('last_name', 'LIKE', "%$this->search%");
        if ($this->sort_field) {
            if ($this->sort_ascending) {
                $query->orderBy($this->sort_field);
            } else {
                $query->orderByDesc($this->sort_field);
            }
        }

        return view('livewire.users', ['users' => $query->paginate(10)]);
    }
}
