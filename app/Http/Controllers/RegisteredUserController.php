<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6)->mixedCase()->letters()->numbers()->symbols(), 'confirmed'],
        ]);

        $user = User::create($validatedData);

        Auth::login($user);

        return redirect('/posts');
    }
}
