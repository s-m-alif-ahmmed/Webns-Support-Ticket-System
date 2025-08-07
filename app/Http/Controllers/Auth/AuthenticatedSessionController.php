<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin\User\CompanyUser;
use App\Models\User;
use App\Providers\AppServiceProvider;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
//    public function store(LoginRequest $request): RedirectResponse
//    {
//        $request->authenticate();
//
//        $request->session()->regenerate();
//
//        return redirect()->intended(route('dashboard', absolute: false));
//    }

    public function store(Request $request)
    {
        $this->validateLogin($request);

        // Get user by login (email or employee_id)
        $user = $this->getUserByLogin($request->input('login'));

        // Check if user exists and passwords match
        if ($user && $this->checkPassword($request->input('password'), $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        throw ValidationException::withMessages([
            'login' => __('auth.failed'),
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
    }

    protected function getUserByLogin($login)
    {
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'employee_id';

        $user = User::where($field, $login)->first();

        return $user;
    }

    protected function checkPassword($inputPassword, $storedPassword)
    {
        return $inputPassword === $storedPassword;
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
