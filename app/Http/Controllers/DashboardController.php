<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        $merchant = auth()->user()->merchant;

        if ($merchant && in_array($merchant->merchant_status, ['Pending', 'Rejected'])) {
            abort(403);
        }

        $total_event_tickets = Product::count();
        $total_merchants = User::where('role', '=', 'Merchant')->count();
        $total_users = User::count();
        $total_pending_merchants = Merchant::where('merchant_status', '=', 'Pending')->count();

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'total_event_tickets' => $total_event_tickets,
            'total_merchants' => $total_merchants,
            'total_users' => $total_users,
            'total_pending_merchants' => $total_pending_merchants,
        ]);
    }

    public function merchant_all()
    {
        $merchants = Merchant::paginate(8);
        $pending_merchants = Merchant::where('merchant_status', '=', 'Pending')->get();

        $title = 'Delete User!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        if (Gate::allows('admin')) {
            return view('dashboard.all_merchants', [
                'title' => 'Pending Merchants',
                'merchants' => $merchants,
                'pending_merchants' => $pending_merchants,
            ]);
        } else {
            abort(403);
        }
    }
}
