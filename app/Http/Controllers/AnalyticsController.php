<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AnalyticsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $title = 'View Analytics Report';

        $products = Product::where('merchant_id', $user->merchant->id)->latest()->get();

        return view('dashboard.analytics.index', compact('title', 'products'));
    }

    public function analyticsReport($productId)
    {
        $product = Product::with('ticketTypes')->findOrFail($productId);

        $title = 'Analytic Report: ' . ucfirst($product->event_title);
    
        if ($product->merchant_id !== auth()->user()->merchant->id) {
            abort(404);
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
    
        // Kirim data ke view
        return view('dashboard.analytics.report', [
            'title' => $title,
            'product' => $product,
            'totalTickets' => $totalTickets,
            'remainingTickets' => $remainingTickets,
            'ticketDetails' => $ticketDetails,
        ]);
    }
    
}
