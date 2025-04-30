<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();
        \App\Models\Category::factory(3)->create();
        $tags = \App\Models\Tag::factory(5)->create();

        \App\Models\Product::factory(10)->create()->each(function ($product) use ($tags) {
            $product->tags()->attach($tags->random(2));
        });
    }
}
