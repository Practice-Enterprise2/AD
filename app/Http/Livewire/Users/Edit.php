<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component
{
    public User $user;

    protected $rules = [
        'user.name' => User::VALIDATION_RULE_NAME,
        'user.last_name' => User::VALIDATION_RULE_LAST_NAME,
        'user.email' => User::VALIDATION_RULE_EMAIL,
    ];

    public function mount(int $user_id): void
    {
        $this->user = User::query()->findOrFail($user_id);
    }

    public function render(): View
    {
        return view('livewire.users.edit');
    }

    public function save(): void
    {
        $this->validate();

        $this->user->save();
        $this->emit('username_changed');
    }
}
