<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public array $messages = [
        "username.required" => "Username is required",
        "username.exists" => "Username doesn't exists",
        "password.required" => "Password is required",
    ];

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required|min:3|max:255|exists:users,username',
            'password' => 'required',
        ], $this->messages);

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'credentials' => 'Your provided credentials could not be verified.',
            ]);
        }

        session()->regenerate();

        return redirect('/')->with('success', 'You have been authorized successfully.');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
