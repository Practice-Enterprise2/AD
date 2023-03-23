<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => 'required|min:8|max:11|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address' => 'max:100',
            'postalcode' => 'numeric',
            'city' => ['string', 'max:255'],
            'country' => ['string', 'max:100'],
        ];
    }
}
