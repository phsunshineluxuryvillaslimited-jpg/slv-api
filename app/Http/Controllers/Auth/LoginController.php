<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $user = $request->user();

        $token = $user->createToken('main')->plainTextToken;

        // $request->session()->regenerate();

        return [
            'user' => new UserResource($user),
            'token' => $token,
        ];

        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return response()->noContent();
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only(['email', 'password']);
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('dashboard');
    //     }

    //     return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    // }

}
