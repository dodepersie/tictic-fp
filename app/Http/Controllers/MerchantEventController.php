<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

class MerchantEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get event by Merchant ID
        $userId = auth()->user()->merchant->id;
        $events =  Product::where('merchant_id', $userId)->latest()->get();

        return view('dashboard.event.index', [
            'title' => 'Merchant Events',
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.event.create', [
            'title' => 'Create Events'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['merchant_id'] = auth()->user()->merchant->id;

        if ($request->hasFile('event_image')) {
            // Load the image
            $file = $request->file('event_image');
            $image = Image::read($file);
            
            // Make the image fit and convert to WEBP format
            $image->coverDown(1024, 768);
            $image->encode(new WebpEncoder(quality: 90));
            $file_name = now()->timestamp . '.webp';

            // Save the resized image to storage
            Storage::put('public/event_images/' . $file_name, (string) $image->encode());

            // Put the data in the database
            $validatedData['event_image'] = $file_name;
        }

        Product::create($validatedData);

        return redirect()->route('merchant_events.index')->withSuccess('Create event successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $eventData = Product::findOrFail($id);

        if (auth()->user()->merchant->id !== $eventData->merchant_id) {
            abort(403);
        }
    
        return view('dashboard.event.edit', [
            'event' => $eventData,
            'title' => 'Edit Event: ' . $eventData->event_title
        ]);
    }    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $validatedData = $request->validated();
        $validatedData['merchant_id'] = auth()->user()->merchant->id;
        $product = Product::find($id);

        if ($request->hasFile('event_image')) {
            // Load the image
            $file = $request->file('event_image');
            $image = Image::read($file);
            
            // Make the image fit and convert to WEBP format
            $image->coverDown(1024, 768);
            $image->encode(new WebpEncoder(quality: 90));
            $file_name = now()->timestamp . '.webp';

            // Save the resized image to storage
            Storage::put('public/event_images/' . $file_name, (string) $image->encode());

            // Delete old profile picture
            if ($product->event_image) {
                $path = public_path('storage/event_images/'. $product->event_image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Put the data in the database
            $validatedData['event_image'] = $file_name;
        }

        $product->update($validatedData);
        return redirect()->back()->withSuccess('Event edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('success', 'Event deleted successfully');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
