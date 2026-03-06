<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Auth;
class AlbumController extends Controller
{

    public function index()
    {
        $albums = Album::where('user_id', Auth::id())->latest()->get();
        return view('albums.index', compact('albums'));
    }
    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'cover_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('cover_photo')) {
            $path = $request->file('cover_photo')->store('albums', 'public');
        }

        Album::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'cover_photo' => $path,
            'is_public' => $request->has('is_public'),
            'status' => $request->status ?? 'active'
        ]);

        return redirect()->route('albums.index')->with('success','Album created');
    }
}
