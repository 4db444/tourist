<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            "Beach",
            "Mountain",
            "Desert",
            "Historical Monuments",
            "Cultural Discovery",
            "Gastronomy / Food Tour",
            "Adventure & Sports",
            "Nature & National Parks",
            "City Exploration",
            "Relaxation & Wellness"
        ];

        foreach($categories as $category){
            Category::create([
                "name" => $category
            ]);
        }
    }
}
