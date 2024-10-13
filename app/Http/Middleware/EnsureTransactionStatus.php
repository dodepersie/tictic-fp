<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTransactionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $transaction = $request->route('transaction');

        if ($transaction->status == Transaction::STATUS_PENDING || $transaction->status == Transaction::STATUS_CANCELED) {
            abort(403, 'You can\'t access this page directly!');
        }

        return $next($request);
    }
}
