<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "View Ticket Detail";
        return view('view-ticket-detail', compact('title'));
    }

    public function all_transactions(Transaction $transaction){
        $title = 'All Transactions';
        $transactions = Transaction::where('user_id', '=', auth()->user()->id)->get();

        return view('dashboard.transactions.index', compact('title', 'transactions'));
    }

    public function viewTicketDetail(Request $request) {
        $request->validate([
            'unique_id' => 'required|string|max:8',
        ]);
    
        $uniqueId = $request->unique_id;
    
        $transaction = Transaction::where('unique_id', $uniqueId)->first();
    
        if (!$transaction) {
            return redirect()->back()->withErrors(['unique_id' => 'Ticket not found.']);
        }
    
        return redirect()->back()->with('transaction', $transaction);
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
