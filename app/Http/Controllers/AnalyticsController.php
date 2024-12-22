<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;

class AnalyticsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'View Analytics Report';
        $merchants = [];

        if ($user->role === 'Admin') {
            $merchants = Merchant::where('merchant_status', 'Approved')->latest()->get();
            $products = Product::latest()->get();
        } else {
            $products = Product::where('merchant_id', $user->merchant->id)->latest()->get();
        }

        return view('dashboard.analytics.index', compact('title', 'merchants', 'products'));
    }

    public function analyticsReport($productId, $merchantId = null)
    {
        $user = auth()->user();
        $product = Product::with('ticketTypes')->findOrFail($productId);
    
        $title = 'Analytic Report of ' . ucfirst($product->event_title);
    
        if ($user->role === "Merchant") {
            if ($product->merchant_id !== $user->merchant->id) {
                abort(403, 'You do not have access to this report.');
            }
        }
    
        $totalTickets = $product->ticketTypes->sum('quantity');
    
        $remainingTickets = $product->ticketTypes->sum(function ($ticketType) {
            return $ticketType->quantity - ($ticketType->sold_quantity ?? 0);
        });
    
        $ticketDetails = $product->ticketTypes->map(function ($ticketType) {
            return [
                'type' => $ticketType->type,
                'available' => $ticketType->quantity,
                'sold_quantity' => $ticketType->sold_quantity ?? 0,
                'remaining' => $ticketType->quantity - ($ticketType->sold_quantity ?? 0),
                'price' => $ticketType->price,
            ];
        });
    
        return view('dashboard.analytics.report', [
            'title' => $title,
            'product' => $product,
            'totalTickets' => $totalTickets,
            'remainingTickets' => $remainingTickets,
            'ticketDetails' => $ticketDetails,
        ]);
    }
    

    public function adminAnalyticsReport($merchantId){
        $merchant = Merchant::findOrFail($merchantId);
        $products = Product::where('merchant_id', $merchantId)->get();

        $title = 'Analytic Report of ' .$merchant->user->name;

        return view('dashboard.analytics.admin-report', [
            'title' => $title,
            'merchant' => $merchant,
            'products' => $products,
        ]);
    }
}
