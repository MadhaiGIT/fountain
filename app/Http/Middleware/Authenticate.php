<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return redirect()->route('login');
        }
    }

    public function handle(Request $request, \Closure $next, $role = 'admin') {

        $user = $request->session()->get('user');
        if ($user != null) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
