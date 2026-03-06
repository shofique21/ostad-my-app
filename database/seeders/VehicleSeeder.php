<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'user_id'        => 1,
                'category_id'    => 1,
                'title'          => 'Toyota Camry 2022 - Excellent Condition',
                'brand'          => 'Toyota',
                'model'          => 'Camry',
                'year'           => 2022,
                'condition'      => 'Used',
                'milage'         => '15000',
                'fuel_type'      => 'Petrol',
                'transmission'   => 'Automatic',
                'description'    => 'Well-maintained Toyota Camry with low mileage. Single owner, no accidents.',
                'location'       => 'Dhaka',
                'contact_number' => '01711111111',
                'is_active'      => true,
            ],
            [
                'user_id'        => 1,
                'category_id'    => 2,
                'title'          => 'Honda CR-V 2021 - SUV Family Car',
                'brand'          => 'Honda',
                'model'          => 'CR-V',
                'year'           => 2021,
                'condition'      => 'Used',
                'milage'         => '22000',
                'fuel_type'      => 'Petrol',
                'transmission'   => 'Automatic',
                'description'    => 'Spacious Honda CR-V, perfect for family use. Full service history available.',
                'location'       => 'Chittagong',
                'contact_number' => '01722222222',
                'is_active'      => true,
            ],
            [
                'user_id'        => 2,
                'category_id'    => 3,
                'title'          => 'Ford Ranger 2020 - Powerful Pickup Truck',
                'brand'          => 'Ford',
                'model'          => 'Ranger',
                'year'           => 2020,
                'condition'      => 'Used',
                'milage'         => '45000',
                'fuel_type'      => 'Diesel',
                'transmission'   => 'Manual',
                'description'    => 'Ford Ranger in great condition. Suitable for both city and off-road driving.',
                'location'       => 'Sylhet',
                'contact_number' => '01733333333',
                'is_active'      => true,
            ],
            [
                'user_id'        => 2,
                'category_id'    => 4,
                'title'          => 'Toyota Yaris 2023 - Fuel Efficient Hatchback',
                'brand'          => 'Toyota',
                'model'          => 'Yaris',
                'year'           => 2023,
                'condition'      => 'New',
                'milage'         => '500',
                'fuel_type'      => 'Hybrid',
                'transmission'   => 'Automatic',
                'description'    => 'Brand new Toyota Yaris Hybrid. Excellent fuel economy, perfect for city driving.',
                'location'       => 'Dhaka',
                'contact_number' => '01744444444',
                'is_active'      => true,
            ],
            [
                'user_id'        => 1,
                'category_id'    => 8,
                'title'          => 'Tesla Model 3 2022 - Electric Sedan',
                'brand'          => 'Tesla',
                'model'          => 'Model 3',
                'year'           => 2022,
                'condition'      => 'Used',
                'milage'         => '18000',
                'fuel_type'      => 'Electric',
                'transmission'   => 'Automatic',
                'description'    => 'Tesla Model 3 Long Range. Full self-driving capability. One owner.',
                'location'       => 'Dhaka',
                'contact_number' => '01755555555',
                'is_active'      => true,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            DB::table('vehicles')->insert(array_merge($vehicle, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
