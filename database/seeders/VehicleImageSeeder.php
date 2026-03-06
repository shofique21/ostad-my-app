<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            // Vehicle 1 - Toyota Camry
            ['vehicle_id' => 1, 'image_path' => 'vehicle-images/camry-1.jpg'],
            ['vehicle_id' => 1, 'image_path' => 'vehicle-images/camry-2.jpg'],
            ['vehicle_id' => 1, 'image_path' => 'vehicle-images/camry-3.jpg'],

            // Vehicle 2 - Honda CR-V
            ['vehicle_id' => 2, 'image_path' => 'vehicle-images/crv-1.jpg'],
            ['vehicle_id' => 2, 'image_path' => 'vehicle-images/crv-2.jpg'],

            // Vehicle 3 - Ford Ranger
            ['vehicle_id' => 3, 'image_path' => 'vehicle-images/ranger-1.jpg'],
            ['vehicle_id' => 3, 'image_path' => 'vehicle-images/ranger-2.jpg'],
            ['vehicle_id' => 3, 'image_path' => 'vehicle-images/ranger-3.jpg'],

            // Vehicle 4 - Toyota Yaris
            ['vehicle_id' => 4, 'image_path' => 'vehicle-images/yaris-1.jpg'],
            ['vehicle_id' => 4, 'image_path' => 'vehicle-images/yaris-2.jpg'],

            // Vehicle 5 - Tesla Model 3
            ['vehicle_id' => 5, 'image_path' => 'vehicle-images/tesla-1.jpg'],
            ['vehicle_id' => 5, 'image_path' => 'vehicle-images/tesla-2.jpg'],
            ['vehicle_id' => 5, 'image_path' => 'vehicle-images/tesla-3.jpg'],
        ];

        foreach ($images as $image) {
            DB::table('vehicle_images')->insert(array_merge($image, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
