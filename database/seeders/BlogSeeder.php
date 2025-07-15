<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'title' => 'The Art of Brewing the Perfect Coffee',
                'description' => 'A quick guide to making the best coffee in town.',
                'full_description' => 'In this blog, we dive deep into the world of coffee brewing...',
                'image' => asset('images/coffee/espresso.jpg'), // Ensure the image exists in storage
                'author' => 'John Doe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '5 Must-Try Pastries at Our Café',
                'description' => 'Discover the most delicious pastries that pair perfectly with your coffee.',
                'full_description' => 'From croissants to muffins, our café offers a variety of freshly baked goods...',
                'image' =>asset('images/breakfast/omelette.jpg'),
                'author' => 'Jane Smith',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Secret Behind Our Signature Espresso',
                'description' => 'Learn what makes our espresso stand out from the rest.',
                'full_description' => 'Our café takes pride in selecting the best coffee beans and...',
                'image' => 'images/espresso.jpg',
                'author' => 'Michael Brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
