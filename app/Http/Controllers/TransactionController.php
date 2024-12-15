<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'View Ticket Detail';

        if (! $request->has('id')) {
            return view('view-ticket-detail', compact('title'));
        }

        $request->validate([
            'id' => 'required|string|max:8',
        ]);

        $uniqueId = $request->id;
        $user = auth()->user();
        $transaction = null;

        if ($user->role === 'Merchant' && $user->merchant) {
            $transaction = Transaction::where('unique_id', $uniqueId)->first();

            if (! $transaction) {
                abort(404, 'Ticket not found.');
            }
        } elseif ($user->role === 'Customer') {
            $transaction = Transaction::where('unique_id', $uniqueId)
                ->where('user_id', $user->id)
                ->first();

            if (! $transaction) {
                abort(404);
            }
        } else {
            abort(403, 'You do not have the necessary permissions.');
        }

        return view('view-ticket-detail', compact('title', 'transaction'));
    }

    public function all_transactions(Transaction $transaction)
    {
        $title = 'All Transactions';
        $transactions = Transaction::where('user_id', auth()->user()->id)->latest()->get();

        return view('dashboard.transactions.index', compact('title', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
