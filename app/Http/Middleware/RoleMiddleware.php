<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Allow multiple roles separated by '|' or ',' (e.g. 'admin|cajero')
        $allowed = preg_split('/[|,]/', $role);

        if (! Auth::check() || ! in_array(Auth::user()->role, $allowed, true)) {
            return redirect('/');
        }

        return $next($request);
    }
}


