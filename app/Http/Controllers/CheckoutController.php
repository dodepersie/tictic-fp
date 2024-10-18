<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TicketType;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function generateUniqueId($length = 8)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $uniqueId = '';

        for ($i = 0; $i < $length; $i++) {
            $uniqueId .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $uniqueId;
    }

    public function proccess(Request $request)
    {
        $data = $request->all();

        $product = Product::find($data['product_id']);

        if ($product->event_end_date < now()->format('Y-m-d')) {
            return redirect()->back()->withError('Event already ended.');
        }

        if (! $data['ticket_type_id']) {
            return redirect()->back()->withError('Please select a ticket type.');
        }

        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'product_id' => $data['product_id'],
            'ticket_type_id' => $data['ticket_type_id'],
            'quantity' => $data['quantity'],
            'price' => $data['total_price'],
            'status' => 'Pending',
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $uniqueId = $this->generateUniqueId();

        $params = [
            'transaction_details' => [
                'order_id' => $uniqueId,
                'gross_amount' => $data['total_price'],
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone_number,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction->snap_token = $snapToken;
        $transaction->unique_id = $uniqueId;
        $transaction->save();

        return redirect()->route('checkout', $transaction->id);
    }

    public function checkout(Transaction $transaction)
    {
        if (auth()->user()->id != $transaction->user_id) {
            abort(403, 'Unauthorized access.');
        }

        if ($transaction->status === Transaction::STATUS_SUCCESS) {
            return redirect()->route('home')->withSuccess('Event already checkout successfully.');
        }

        $products = config('product');
        $product = collect($products)->firstWhere('id', $transaction->product_id);
        $title = 'Checkout: '.$transaction->product->event_title;

        return view('checkout.index', compact('title', 'transaction', 'product'));
    }

    public function success(Transaction $transaction)
    {
        if (auth()->user()->id != $transaction->user_id) {
            abort(403, 'Unauthorized access.');
        }

        if ($transaction->status === 'Success') {
            return redirect()->route('home')->withErrors('This transaction already success and cannot be accessed again.');
        }

        // THIS STILL BUG, USER STILL ACCESS THE URL BUT THEY STILL NOT DO PAYMENT YET
        // if ($transaction->status === 'Pending') {
        //     return redirect()->route('home')->withErrors('This transaction is still in the payment process.');
        // }

        $ticketType = TicketType::where('product_id', $transaction->product_id)
            ->where('id', $transaction->ticket_type_id)
            ->firstOrFail();

        $ticketType->decrement('quantity', $transaction->quantity);

        $title = 'Checkout Success: '.$transaction->product->event_title;
        $transaction->status = 'Success';
        $transaction->markAsSuccess();
        $transaction->save();

        return view('checkout.success', compact('title', 'transaction'));
    }
}
