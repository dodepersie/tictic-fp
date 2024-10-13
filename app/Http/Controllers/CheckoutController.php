<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() {
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

    public function proccess(Request $request) {

        $data = $request->all();

        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'product_id' => $data['product_id'],
            'price' => $data['price'],
            'status' => 'Pending',
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $uniqueId = $this->generateUniqueId();

        $params = array(
            'transaction_details' => array(
                'order_id' => $uniqueId,
                'gross_amount' => $data['price'],
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
                'phone'      => auth()->user()->phone_number,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction->snap_token = $snapToken;
        $transaction->unique_id = $uniqueId;
        $transaction->save();

        return redirect()->route('checkout', $transaction->id);
    }

    public function checkout(Transaction $transaction) {
        if (auth()->user()->id != $transaction->user_id) {
            abort(403, 'Unauthorized access.');
        }

        if ($transaction->status === Transaction::STATUS_SUCCESS) {
            return redirect()->route('checkout-success', ['transaction' => $transaction->id]);
        }

        $products = config('product');
        $product = collect($products)->firstWhere('id', $transaction->product_id);
        $title = 'Checkout: ' . $transaction->product->event_title;

        return view('checkout.index', compact('title', 'transaction', 'product'));
    }

    public function success(Transaction $transaction) {
        if (auth()->user()->id != $transaction->user_id) {
            abort(403, 'Unauthorized access.');
        }

        $title = "Checkout Success: " . $transaction->product->event_title;
        $transaction->status = 'Success';
        $transaction->markAsSuccess();
        $transaction->save();

        return view('checkout.success', compact('title', 'transaction'));
    }
}