<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'street' => ['required', 'string', 'max:255'],
            'house_number' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
        ]);

        // HACK: This solves the fact that the `unique` validation rule doesn't
        // take soft deletion into account.

        if (!User::query()->where('email', $request->email)->first()) {
            // Create the address
            $address = Address::query()->create([
                'street' => $request->street,
                'house_number' => $request->house_number,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]);
        
            $address_id = $address->id;
        
            $user = new User();
            $user ->name = $request['name'];
            $user ->email = $request['email'];
            $user ->password = Hash::make($request['password']);
            $user ->address_id = $address_id;
            $user->save();

            // TODO: Enable this once the mail server is up and running.
            /* event(new Registered($user)); */
        
            Auth::login($user);
        
            $user->assignRole('user');

            return redirect(RouteServiceProvider::HOME);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }
    }
}
