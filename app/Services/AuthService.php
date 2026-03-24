<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param array<string, string> $credentials
     * @return bool
     * @throws ValidationException
     */
    public function authenticate(array $credentials): bool
    {
        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return true;
        }

        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
