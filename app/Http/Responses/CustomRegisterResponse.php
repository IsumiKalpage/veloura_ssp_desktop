<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class CustomRegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // Flash success message
        session()->flash('success', 'Account successfully registered! Please log in.');

        // Redirect to login page instead of auto-login
        return redirect()->route('login');
    }
}
