<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
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

        // For Admin
        if (auth()->user()->role === 'Admin') {
            $total_event_tickets = Product::count();
            $total_merchants = User::where('role', '=', 'Merchant')->count();
            $total_users = User::count();
            $total_pending_merchants = Merchant::where('merchant_status', '=', 'Pending')->count();
        }

        // For Merchant
        if (auth()->user()->role === 'Merchant') {
            $total_merchant_events = Product::where('merchant_id', auth()->user()->merchant->id)->count();
            $total_active_event = Product::where('merchant_id', auth()->user()->merchant->id)
                ->where('event_start_date', '<=', now())
                ->whereDate('event_end_date', '>=', now())
                ->count();
        }

        return view('dashboard.index', compact('title', 'total_event_tickets', 'total_merchants', 'total_users', 'total_pending_merchants', 'total_merchant_events', 'total_active_event'));
    }
}
