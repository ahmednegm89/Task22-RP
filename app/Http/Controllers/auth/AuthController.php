<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HandleLoginRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function hLogin(HandleLoginRequest $request)
    {
        $validated = $request->validated();
        $login = $validated['credential'];
        $cred = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $is_login = Auth::attempt([
            $cred =>  $login,
            'password' => $validated['password']
        ]);

        if (!$is_login) {
            return back();
        }
        if (Auth::user()->role->name != 'admin') {
            return redirect('/user');
        }
        return redirect('/admin/dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('auth.login'));
    }
}
