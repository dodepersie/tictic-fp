<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['reviews', 'ticketTypes'])->latest()->take(4)->get();

        return view('home', [
            'title' => 'Home',
            'products' => $products,
        ]);
    }
}
