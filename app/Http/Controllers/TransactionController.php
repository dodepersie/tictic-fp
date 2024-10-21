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
    public function index()
    {
        $title = 'View Ticket Detail';

        return view('view-ticket-detail', compact('title'));
    }

    public function all_transactions(Transaction $transaction)
    {
        $title = 'All Transactions';
        $transactions = Transaction::where('user_id', '=', auth()->user()->id)->latest()->get();

        return view('dashboard.transactions.index', compact('title', 'transactions'));
    }

    public function viewTicketDetail(Request $request)
    {
        $request->validate([
            'unique_id' => 'required|string|max:8',
        ]);

        $uniqueId = $request->unique_id;

        if (auth()->user()->role === 'Merchant') {
            // Jika user adalah Merchant, mereka dapat melihat semua transaksi berdasarkan unique ID
            $transaction = Transaction::where('unique_id', $uniqueId)->first();
            
            if (! $transaction) {
                return redirect()->back()->withErrors(['unique_id' => 'Ticket not found.']);
            }
        } elseif (auth()->user()->role === 'Customer') {
            // Jika user adalah Customer, mereka hanya dapat melihat transaksi mereka sendiri berdasarkan unique ID
            $transaction = Transaction::where('unique_id', $uniqueId)
                ->where('user_id', auth()->user()->id)
                ->first();
            
            if (! $transaction) {
                return redirect()->back()->withErrors(['unique_id' => 'Ticket not found or you do not have access to this ticket.']);
            }
        } else {
            // Jika user tidak berperan sebagai Merchant atau Customer, tampilkan pesan error
            return redirect()->back()->withErrors(['role' => 'You do not have the necessary permissions.']);
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
