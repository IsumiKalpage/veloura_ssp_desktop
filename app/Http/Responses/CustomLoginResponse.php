<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        $adminEmail = env('ADMIN_EMAIL', 'admin@gmail.com');
        $isAdmin = ($user->email === $adminEmail) || ((string)($user->role ?? '') === 'admin');

        return redirect()->intended(
            $isAdmin ? route('admindashboard') : route('dashboard')
        );
    }
}
