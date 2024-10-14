<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Merchant;
use App\Models\Transaction;
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
            $title .= ' by ' . ucfirst($merchant->user->name);
        } 
    
        // Check if the request is for a location
        if ($location = request('location')) {
            $title .= ' at ' . ucfirst($location);
        }      

        // Check if the request is for a category
        if ($category = request('category')) {
            $title .= ' at ' . ucfirst($category);
        }      
    
        return view('event.index', [
            'title' => "Events" . $title,
            'products' => Product::latest()->filter(request(['search', 'merchant', 'location', 'category']))->paginate(6),
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
        $reviews = Review::where('product_id', $product->id)->latest()->get();
        $averageRating = $product->reviews()->avg('rating');
        $reviewsCount = $reviews->count();
    
        return view('event.show', [
            'title' => $product->event_title,
            'product' => $product,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
            'reviewsCount' => $reviewsCount,
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
