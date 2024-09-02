<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Package;
use App\Models\Feature;
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
            'password' => bcrypt('12345'),
        ]);


        Feature::create([
            'image' => 'https://static-00.iconduck.com/assets.00/plus-icon-2048x2048-z6v59bd6.png',
            'route_name' => 'feature1.index',
            "name" => "Calculate Sum",
            "description" => "This feature adds two numbers.",
            "required_credits" => 1,
            "active" => true
        ]);

        Feature::create([
            'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_otN-0S1RMR8KohQ8NR3dXmGDAO-J2Lk4QQ&s',
            'route_name' => 'feature2.index',
            "name" => "Calculate Difference",
            "description" => "Calculate difference of two numbers.",
            "required_credits" => 3,
            "active" => true
        ]);

        Package::create([
            'name' => 'Basic',
            'price' => 5,
            'credits' => 20,
        ]);

        Package::create([
            'name' => 'Silver',
            'price' => 20,
            'credits' => 100,
        ]);

        Package::create([
            'name' => 'Gold',
            'price' => 50,
            'credits' => 500,
        ]);
    }
}
