<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Merchant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = '';
    
        // Check if the request is for a merchant
        if ($merchantId = request('merchant')) {
            $merchant = Merchant::where('id', $merchantId)->firstOrFail();
            $title .= ' by ' . $merchant->user->name;
        } 
    
        // Check if the request is for a location
        if ($location = request('location')) {
            $title .= ' at ' . $location;
        }      
    
        return view('event.index', [
            'title' => "Events" . $title,
            'products' => Product::latest()->filter(request(['search', 'merchant', 'location']))->paginate(6),
        ]);
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('event.show', [
            'title' => $product->event_title,
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
