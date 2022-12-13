<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;



    /**
     * UserController constructor
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }



    /**
     * login form
     *
     * @return View
     */
    public function loginForm(): View
    {
        return view("auth/loginForm");
    }



    /**
     * register form
     *
     * @return View
     */
    public function registerForm(): View
    {
        return view("auth/registerForm");
    }



    /**
     * register the user
     *
     * @param UserRegisterRequest $request
     *
     * @return RedirectResponse
     */
    public function register(UserRegisterRequest $request): RedirectResponse
    {
        $request->merge([
            "password" => Hash::make($request->password),
        ]);

        $user = $this->userRepository->register($request->toArray());

        if ($user->exists) {
            Auth::login($user);
            return redirect()->route("transaction-form");
        }

        return back()->withErrors([
            'register' => 'Register failed.',
        ]);
    }



    /**
     * login the registered user
     *
     * @param UserLoginRequest $request
     *
     * @return RedirectResponse
     */
    public function login(UserLoginRequest $request): RedirectResponse
    {
        if (Auth::attempt([
            "email"    => $request->email,
            "password" => $request->password,
        ])) {
            $request->session()->regenerate()
            ;
            if (Auth::user()->isAdmin()) {
                return redirect()->route("transaction-list");
            }
            return redirect()->route("transaction-form");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email')
        ;
    }



    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate()
        ;

        $request->session()->regenerateToken()
        ;

        return redirect('/login');
    }
}
