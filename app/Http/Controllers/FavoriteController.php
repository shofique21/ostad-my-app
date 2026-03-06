<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('vehicle.images')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $existing = Favorite::where('user_id', Auth::id())
            ->where('vehicle_id', $vehicle->id)
            ->first();

        if (!$existing) {
            Favorite::create([
                'user_id'    => Auth::id(),
                'vehicle_id' => $vehicle->id,
            ]);
        }

        return back()->with('success', 'Vehicle added to favourites.');
    }

    public function destroy(Vehicle $vehicle)
    {
        Favorite::where('user_id', Auth::id())
            ->where('vehicle_id', $vehicle->id)
            ->delete();

        return back()->with('success', 'Vehicle removed from favourites.');
    }
}
