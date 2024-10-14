<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('reviews')->latest()->take(4)->get();

        return view('home', [
            'title' => 'Home',
            'products' => $products,
        ]);
    }
}
