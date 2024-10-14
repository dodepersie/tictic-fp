<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'merchant_id' => fake()->numberBetween(1, 2),
            'category_id' => fake()->numberBetween(1, 2),
            'event_title' => fake()->words(3, true),
            'slug' => fake()->slug(),
            'event_detail' => fake()->paragraphs(20, true),
            'event_price' => fake()->randomNumber(5, true),
            'event_start_date' => fake()->dateTimeThisYear()->format('Y-m-d'),
            'event_start_time' => fake()->dateTimeThisYear()->format('H:i:s'),
            'event_location' => 'Denpasar',
            'event_location_longitude' => '1',
            'event_location_latitude' => '1',
        ];
    }
}
