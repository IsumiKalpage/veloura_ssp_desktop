<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Allow only the admin user.
     * Admin is either the user whose email equals ADMIN_EMAIL
     * or anyone with role === 'admin' (kept to match your table).
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $adminEmail = env('ADMIN_EMAIL', 'admin@gmail.com');

        $isAdmin = ($user->email === $adminEmail) || ((string)($user->role ?? '') === 'admin');

        if (!$isAdmin) {
            // You can redirect to dashboard instead of abort if you prefer:
            // return redirect()->route('dashboard')->with('error', 'Not authorized.');
            abort(403, 'Only the admin can access this page.');
        }

        return $next($request);
    }
}
