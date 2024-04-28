<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        Brand::insert([
            ['name' => 'BigC'],
            ['name' => 'Nestale'],
        ]);

        Category::insert([
            ['name' => 'Fresh Fruits'],
            ['name' => 'Drink Fruits'],
            ['name' => 'Dried Fruits'],
            ['name' => 'Vegetables'],
            ['name' => 'Coffee'],
        ]);

        $front = Permission::create([
            'name' => 'front',
        ]);

        $back = Permission::create([
            'name' => 'back',
        ]);

        $userRole = Role::create([
            'name' => 'customer',
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $userRole->givePermissionTo($front);
        $adminRole->givePermissionTo($back);

        $user->assignRole($userRole);
        $admin->assignRole($adminRole);
    }
}
