<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        // If user is not logged in, let them through to login
        if (!$user) {
            return $next($request);
        }
        
        // If email is verified, let them through
        if ($user->email_verified_at) {
            return $next($request);
        }
        
        // If user is on the verification page already, let them through
        if ($request->routeIs('login.verify') || $request->routeIs('login.verify.link') || $request->routeIs('login.verify.resend')) {
            return $next($request);
        }
        
        // Redirect to verification page
        return redirect()->route('login.verify');
    }
}
