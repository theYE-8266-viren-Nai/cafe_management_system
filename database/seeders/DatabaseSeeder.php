<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::create([
        //     'name' => 'Test User',
        //     'email' => 'test1@example.com',
        //     'phone' => '0989583967' ,
        //     'address' => 'Yangon'  ,
        //     'role' => 'admin' ,
        //     'password' => Hash::make('thuriya234')
        // ]);
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'phone' => '0989583967' ,
            'address' => 'Yangon'  ,
            'role' => 'admin' ,
            'password' => Hash::make('thuriya234')
        ]);
        User::create([
            'name' => 'This is user',
            'email' => 'thuriyayenaing@gmail.com',
            'phone' => '0989583967' ,
            'address' => 'Yangon'  ,
            'role' => 'user' ,
            'password' => Hash::make('thuriya234naing')
        ]);
        // Product::create([
        //     'name' => $this->faker->word,
        //     'category_id' => 1, // Assuming category_id 1 exists
        //     'description' => $this->faker->sentence,
        //     'image' => 'default.jpg', // Default image placeholder
        //     'price' => $this->faker->randomFloat(2, 5, 100),
        //     'stock' => $this->faker->numberBetween(10, 100),
        //     'view_count' => $this->faker->numberBetween(0, 500),
        // ]);
    }
}
