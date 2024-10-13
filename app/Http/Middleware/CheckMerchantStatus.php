<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMerchantStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $merchant = auth()->user()->merchant;

        // Check if the user is a merchant and their status is 'Pending' or 'Rejected'
        if ($merchant && in_array($merchant->merchant_status, ['Pending', 'Rejected'])) {
            abort(403, 'Your merchant status is ' . $merchant->merchant_status . '.');
        }

        return $next($request);
    }
}
