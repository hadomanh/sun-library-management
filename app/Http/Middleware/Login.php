<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \App\Models\User;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!User::where('email', '=', $request->email)->get()->first()->is_blocked) {
            return $next($request);
        }

        return redirect()->back()->withErrors(['Your account is blocked']);
    }
}
