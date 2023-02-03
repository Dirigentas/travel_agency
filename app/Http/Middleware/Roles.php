<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roliukai)
    {
        $middlewareRoles = explode('|', $roliukai);
        $middlewareRoles = array_map(fn($r) => User::ROLES[$r], $middlewareRoles);
        
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('home');
        }

        if (in_array($user->role, $middlewareRoles)) {
            return $next($request);
        }
        
        abort(401);
    }
}