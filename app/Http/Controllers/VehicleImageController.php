<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleImageController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        $images = $vehicle->images()->latest()->get();
        return view('vehicle-images.index', compact('vehicle', 'images'));
    }

    public function store(Request $request, Vehicle $vehicle)
    {
       
        $this->authorizeVehicle($vehicle);

      $sfsdf =   $request->validate([
            'images'   => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        foreach ($request->file('images') as $file) {
           
            $path = $file->store('vehicle-images', 'public');
            VehicleImage::create([
                'vehicle_id' => $vehicle->id,
                'image_path' => $path,
            ]);
        }

        return redirect()->route('vehicles.images.index', $vehicle)
            ->with('success', 'Images uploaded successfully.');
    }

    public function destroy(Vehicle $vehicle, VehicleImage $image)
    {
        $this->authorizeVehicle($vehicle);

        if ($image->vehicle_id !== $vehicle->id) {
            abort(403);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->route('vehicles.images.index', $vehicle)
            ->with('success', 'Image deleted successfully.');
    }

    private function authorizeVehicle(Vehicle $vehicle): void
    {
       
        if ($vehicle->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
