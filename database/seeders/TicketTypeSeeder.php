<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products
        $products = Product::all();

        foreach ($products as $product) {
            // Check if the product already has a Regular ticket
            $existingRegularTicket = TicketType::where('product_id', $product->id)
                ->where('type', 'Regular')
                ->first();

            if (! $existingRegularTicket) {
                // Create a Regular ticket type for the product
                TicketType::factory()->regular()->create([
                    'product_id' => $product->id,
                ]);
            }

            // Create additional ticket types (VIP, VVIP) only if not already created
            $ticketTypes = ['VIP', 'VVIP'];

            foreach ($ticketTypes as $ticketType) {
                TicketType::factory()->create([
                    'product_id' => $product->id,
                    'type' => $ticketType,
                ]);
            }
        }
    }
}
