<?php

namespace App\Http\Controllers;

use App\Models\Catregory;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('user_id', auth()->id())->with('category')->latest()->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $categories = Catregory::where('is_active', true)->get();
        return view('vehicles.create', compact('categories'));
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'category_id'    => 'required|exists:catregories,id',
            'title'          => 'required|string|max:255',
            'brand'          => 'nullable|string|max:255',
            'model'          => 'nullable|string|max:255',
            'year'           => 'nullable|integer|min:1900|max:' . date('Y'),
            'condition'      => 'nullable|string|max:255',
            'milage'         => 'nullable|string|max:255',
            'fuel_type'      => 'nullable|string|max:255',
            'transmission'   => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'location'       => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
        ]);

        Vehicle::create(array_merge($request->except('_token'), [
            'user_id' => auth()->id(),
        ]));

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        $vehicle->load('category', 'images');
        return view('vehicles.show', compact('vehicle'));
    }

    public function toggleActive(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        $vehicle->update(['is_active' => !$vehicle->is_active]);
        return redirect()->route('vehicles.index')->with('success', 'Vehicle status updated.');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        $categories = Catregory::where('is_active', true)->get();
        return view('vehicles.edit', compact('vehicle', 'categories'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);

        $request->validate([
            'category_id'    => 'required|exists:catregories,id',
            'title'          => 'required|string|max:255',
            'brand'          => 'nullable|string|max:255',
            'model'          => 'nullable|string|max:255',
            'year'           => 'nullable|integer|min:1900|max:' . date('Y'),
            'condition'      => 'nullable|string|max:255',
            'milage'         => 'nullable|string|max:255',
            'fuel_type'      => 'nullable|string|max:255',
            'transmission'   => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'location'       => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $vehicle->update($request->except('_token', '_method'));

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorizeVehicle($vehicle);
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    private function authorizeVehicle(Vehicle $vehicle): void
    {
        if ($vehicle->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
