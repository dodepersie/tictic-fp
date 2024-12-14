<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\TicketType;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $events = Product::where('merchant_id', $userId)->latest()->get();

        $title = 'Delete Event!';
        $text = 'Are you sure you want to delete this event?';
        confirmDelete($title, $text);

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
        $categories = Category::all();

        return view('dashboard.event.create', [
            'title' => 'Create Events',
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['merchant_id'] = auth()->user()->merchant->id;
    
        // String untuk menyimpan nama gambar
        $imageNames = [];
    
        if ($request->hasFile('event_images')) {
            foreach ($request->file('event_images') as $file) {
                $image = Image::read($file);
                $image->coverDown(1024, 768);
                $image->encode(new WebpEncoder(quality: 90));
                $file_name = now()->timestamp . '-' . uniqid() . '.webp';  // Generate unique file name
    
                Storage::put('public/event_images/' . $file_name, (string) $image->encode());
    
                // Menambahkan nama file ke dalam string dengan pemisah koma
                $imageNames[] = $file_name;
            }
        }
    
        // Menyimpan nama file gambar sebagai string yang dipisahkan koma
        $validatedData['event_image'] = implode(',', $imageNames);
    
        // Create product and associate the images
        $product = Product::create($validatedData);
    
        // Save ticket types
        $ticketTypes = [
            ['type' => 'VVIP', 'ticket_price' => $request->input('vvip_price'), 'ticket_quantity' => $request->input('vvip_quantity')],
            ['type' => 'VIP', 'ticket_price' => $request->input('vip_price'), 'ticket_quantity' => $request->input('vip_quantity')],
            ['type' => 'Regular', 'ticket_price' => $request->input('regular_price'), 'ticket_quantity' => $request->input('regular_quantity')],
        ];
    
        foreach ($ticketTypes as $ticketType) {
            if (!is_null($ticketType['ticket_price']) && !is_null($ticketType['ticket_quantity'])) {
                TicketType::create([
                    'product_id' => $product->id,
                    'type' => $ticketType['type'],
                    'price' => $ticketType['ticket_price'],
                    'quantity' => $ticketType['ticket_quantity'],
                ]);
            }
        }
    
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
    public function edit($id)
    {
        $eventData = Product::with('ticketTypes')->findOrFail($id);
        $categories = Category::all();

        if (auth()->user()->merchant->id !== $eventData->merchant_id) {
            abort(403);
        }

        return view('dashboard.event.edit', [
            'event' => $eventData,
            'title' => 'Edit Event: '.$eventData->event_title,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $validatedData = $request->validated();
        $validatedData['merchant_id'] = auth()->user()->merchant->id;
    
        $product = Product::findOrFail($id);
    
        if ($request->hasFile('event_images')) {
            $imagePaths = [];
    
            foreach ($request->file('event_images') as $file) {
                $image = Image::read($file);
                $image->coverDown(1024, 768);
                $image->encode(new WebpEncoder(quality: 90));
                $fileName = now()->timestamp . '-' . uniqid() . '.webp';
    
                Storage::put('public/event_images/' . $fileName, (string) $image->encode());
                $imagePaths[] = $fileName;
            }
    
            if ($product->event_image) {
                $oldImages = explode(',', $product->event_image);
                foreach ($oldImages as $oldImage) {
                    $oldPath = public_path('storage/event_images/' . $oldImage);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
            }
    
            $validatedData['event_image'] = implode(',', $imagePaths);
        }
    
        $product->update($validatedData);
    
        return redirect()->back()->withSuccess('Event updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->withSuccess('Event deleted successfully!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}
