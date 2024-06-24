<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
       $userAttributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email','unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);
        $employerAttributes = $request->validate([
            'employer' => ['required', 'string', 'max:255'],
            'logo' => ['required',File::types(['jpg', 'jpeg', 'png'])],
        ]);
       $user = User::create($userAttributes);

        $logoPath=$request->logo->store('logos');

        $user->employer()->create([
            'name' => $employerAttributes['employer'],
            'logo' => $logoPath
        ]);
        Auth::login($user);

        return redirect('/');
    }
}