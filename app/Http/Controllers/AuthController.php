<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        public AuthService $authService
    ) {}

    /**
     * Show the login form.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('menu');
        }

        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $this->authService->authenticate($request->validated());

        return redirect()->intended(route('menu'));
    }

    /**
     * Log the user out of the application.
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()->route('login');
    }
}
