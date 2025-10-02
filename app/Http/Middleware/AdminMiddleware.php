<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $adminEmail = env('ADMIN_EMAIL', 'admin@gmail.com');

        $isAdmin = ($user->email === $adminEmail) || ((string)($user->role ?? '') === 'admin');

        if (!$isAdmin) {

            abort(403, 'Only the admin can access this page.');
        }

        return $next($request);
    }
}
