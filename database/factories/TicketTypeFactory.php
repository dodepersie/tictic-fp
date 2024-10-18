<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketType>
 */
class TicketTypeFactory extends Factory
{
    protected $model = TicketType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => rand(1, 50),
            'type' => $this->faker->randomElement(['VVIP', 'VIP', 'Regular']),
            'price' => $this->faker->numberBetween(50000, 1000000), // adjust price range as necessary
            'quantity' => $this->faker->numberBetween(50, 200),
        ];
    }

    public function regular(): static
    {
        return $this->state([
            'type' => 'Regular',
            'price' => $this->faker->numberBetween(50000, 249999), // Regular price range
        ]);
    }
}
