<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function changeInfo()
    {
        return view('change-info');
    }

    public function profileUpdate(Request $request)
    {
        //validation rules

        $request->validate([
            'name' => 'required|min:4|string|max:255',
            'email' => 'required|email|string|max:255'
        ]);
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];

        $user->save();

        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $user->save();




        return back()->with('message', 'Profile Updated');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
