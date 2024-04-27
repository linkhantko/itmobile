<?php

namespace Database\Seeders;

use App\Models\Category;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::insert([
            ['name' => 'Fresh Fruits'],
            ['name' => 'Drink Fruits'],
            ['name' => 'Dried Fruits'],
            ['name' => 'Vegetables'],
            ['name' => 'Coffee'],
        ]);
    }
}
