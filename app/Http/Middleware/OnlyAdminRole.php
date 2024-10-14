<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user has the role 'Admin'
        if (auth()->check() && auth()->user()->role === 'Admin') {
            return $next($request); // Allow access if the role is Admin
        }

        // If not, abort with a 403 Forbidden response
        abort(Response::HTTP_FORBIDDEN, 'Access denied.');
    }
}
