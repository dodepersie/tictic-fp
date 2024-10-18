<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headingTitle = 'FUNtastic Events!';

        if ($merchantId = request('merchant')) {
            $merchant = Merchant::where('id', $merchantId)->firstOrFail();
            $headingTitle = 'Events by: '.ucfirst($merchant->user->name);
        }

        if ($location = request('location')) {
            $headingTitle = 'Events at: '.ucfirst($location);
        }

        if ($category = request('category')) {
            $headingTitle = 'Events in: '.ucfirst($category);
        }

        $products = Product::latest()->filter(request(['search', 'merchant', 'location', 'category']))->paginate(8);

        $productsCount = $products->total();

        return view('event.index', [
            'title' => $headingTitle,
            'headingTitle' => $productsCount.' '.$headingTitle,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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

        $averageRating = $product->reviews()->avg('rating');
        $reviewsCount = $product->reviews()->count();

        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '<>', $product->id)->inRandomOrder()->get();

        return view('event.show', [
            'title' => $product->event_title,
            'product' => $product,
            'reviews' => $product->reviews,
            'averageRating' => $averageRating,
            'reviewsCount' => $reviewsCount,
            'relatedProducts' => $relatedProducts,
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
