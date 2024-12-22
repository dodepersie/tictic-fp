<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function review_transaction(Transaction $transaction)
    {
        if ($transaction->user_id == auth()->user()->id) {
            if ($transaction->status !== 'Success') {
                abort(403, 'You can only review completed transactions.');
            }

            $existingReview = Review::where('transaction_id', $transaction->id)
                ->where('user_id', auth()->id())
                ->first();

            $title = 'Review Transaction: '.$transaction->product->event_title;

            return view('dashboard.transactions.review.index', compact('title', 'transaction', 'existingReview'));
        } else {
            abort(403);
        }
    }

    public function store_review(Request $request, Transaction $transaction)
    {
        if ($transaction->status !== 'Success') {
            abort(403, 'You can only review completed transactions.');
        }

        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'hide_name' => 'nullable|boolean',
        ]);

        $existingReview = Review::where('transaction_id', $transaction->id)
            ->where('user_id', auth()->id())
            ->first();

        $hideName = $validatedData['hide_name'] = $request->has('hide_name') ? true : false;

        if ($existingReview) {
            $existingReview->update([
                'rating' => $validatedData['rating'],
                'comment' => $validatedData['comment'],
                'hide_name' => $hideName,
                'product_id' => $transaction->product->id,
            ]);
        } else {
            Review::create([
                'transaction_id' => $transaction->id,
                'user_id' => auth()->id(),
                'rating' => $validatedData['rating'],
                'comment' => $validatedData['comment'],
                'hide_name' => $hideName,
                'product_id' => $transaction->product->id,
            ]);
        }

        return redirect()->route('dashboard_transactions.index')
            ->with('success', 'Your review has been submitted successfully.');
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
    public function store(StoreReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
