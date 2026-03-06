<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Sedan',
            'SUV',
            'Truck',
            'Hatchback',
            'Convertible',
            'Coupe',
            'Van',
            'Electric',
        ];

        foreach ($categories as $name) {
            DB::table('catregories')->insert([
                'name'       => $name,
                'slug'       => Str::slug($name),
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
