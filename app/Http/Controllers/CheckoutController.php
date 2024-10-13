<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function proccess(Request $request) {

        $data = $request->all();

        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'product_id' => $data['product_id'],
            'price' => $data['price'],
            'status' => 'Pending',
        ]);

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Parameter untuk Midtrans Snap
        $params = array(
            'transaction_details' => array(
                'order_id' => uniqid(),
                'gross_amount' => $data['price'],
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
            ),
        );

        // Mendapatkan Snap Token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction->snap_token = $snapToken;
        $transaction->save();

        // Redirect ke halaman sukses
        return redirect()->route('checkout', $transaction->id);
    }

    public function checkout(Transaction $transaction) {
        $products = config('product');
        $product = collect($products)->firstWhere('id', $transaction->product_id);
        $title = 'Checkout: ' . $transaction->product->event_title;

        return view('checkout.index', compact('title', 'transaction', 'product'));
    }

    public function success(Transaction $transaction) {
        $title = "Checkout Success: " . $transaction->product->event_title;
        $transaction->status = 'Success';
        $transaction->save();

        return view('checkout.success', compact('title', 'transaction'));
    }
}