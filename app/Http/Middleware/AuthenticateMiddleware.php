<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class AuthenticateMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        if ($request->user() === null) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
