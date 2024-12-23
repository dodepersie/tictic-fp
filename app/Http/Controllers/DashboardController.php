<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard '.auth()->user()->role;

        $merchant = auth()->user()->merchant;

        if ($merchant && in_array($merchant->merchant_status, ['Pending', 'Rejected'])) {
            abort(403);
        }

        // Init
        $total_event_tickets = 0;
        $total_merchants = 0;
        $total_users = 0;
        $total_pending_merchants = 0;
        $total_merchant_events = 0;
        $total_active_event = 0;
        $total_ticket_sold = 0;
        $upcoming_tickets = [];
        $ordered_tickets = 0;
        $active_tickets = 0;

        // For Admin
        if (auth()->user()->role === 'Admin') {
            $total_event_tickets = Product::count();
            $total_merchants = User::where('role', '=', 'Merchant')->count();
            $total_users = User::count();
            $total_pending_merchants = Merchant::where('merchant_status', '=', 'Pending')->count();
        }

        // For Merchant
        if (auth()->user()->role === 'Merchant') {
            $merchant_id = auth()->user()->merchant->id;
            $products = Product::with('ticketTypes.transactions')->where('merchant_id', $merchant_id)->get();
            $total_merchant_events = $products->count();

            $total_active_event = $products->where('event_start_date', '<=', now())
                ->where('event_end_date', '>=', now())
                ->count();

            $total_ticket_sold = $products->sum(function ($product) {
                return $product->ticketTypes->sum(function ($ticketType) {
                    return $ticketType->transactions->sum('quantity');
                });
            });
        }

        // For Customer
        if (auth()->user()->role === 'Customer') {
            $user_id = auth()->user()->id;

            $upcoming_tickets = Transaction::with(['product'])
                ->where('user_id', $user_id)
                ->where('status', 'Success')
                ->whereHas('product', function ($query) {
                    $query->whereBetween('event_start_date', [now(), now()->addWeek()]);
                })
                ->get();

            $ordered_tickets = Transaction::where('status', 'Success')
                ->where('user_id', auth()->user()->id)
                ->count();

            $active_tickets = Transaction::where('user_id', auth()->user()->id)
                ->where('status', 'Success')
                ->whereHas('product', function ($query) {
                    $query->where('event_start_date', '<=', now())
                        ->where('event_end_date', '>=', now());
                })->get();
        }

        return view('dashboard.index', compact(
            'title',
            'total_event_tickets',
            'total_merchants',
            'total_users',
            'total_pending_merchants',
            'total_merchant_events',
            'total_active_event',
            'total_ticket_sold',
            'upcoming_tickets',
            'ordered_tickets',
            'active_tickets'
        ));
    }
}
