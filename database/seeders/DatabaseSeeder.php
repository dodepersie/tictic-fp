<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'a@tictic.id',
            'role' => 'Admin',
        ]);

        $merchant = User::factory()->create([
            'name' => 'Merchant',
            'email' => 'dodepersie@gmail.com',
            'phone_number' => '+6287862191121',
            'role' => 'Merchant',
        ]);

        Merchant::factory()->create([
            'user_id' => $merchant->id,
            'merchant_status' => 'Pending',
        ]);

        $merchant1 = User::factory()->create([
            'name' => 'Merchant 1',
            'email' => 'm@tictic.id',
            'phone_number' => '+6287862191123',
            'role' => 'Merchant',
        ]);

        Merchant::factory()->create([
            'user_id' => $merchant1->id,
            'merchant_status' => 'Approved',
        ]);

        $merchant2 = User::factory()->create([
            'name' => 'Merchant 2',
            'email' => 'm2@tictic.id',
            'phone_number' => '+6287862191125',
            'role' => 'Merchant',
        ]);

        Merchant::factory()->create([
            'user_id' => $merchant2->id,
            'merchant_status' => 'Rejected',
        ]);

        User::factory()->create([
            'name' => 'Dode Mahadi',
            'email' => 'c@tictic.id',
        ]);

        User::factory()->create([
            'name' => 'Dode Mahadi 2',
            'email' => 'd@tictic.id',
        ]);

        Product::factory(1)->create();
    }
}
