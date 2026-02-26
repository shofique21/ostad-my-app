<?php

namespace App\Http\Controllers;

use App\Models\Scamble;
use Illuminate\Http\Request;

class ScamblerController extends Controller
{
    public function index()
    {
         $scambles = Scamble::latest()->get();
        return view('scambles.index', compact('scambles'));
    }

    public function create()
    {
        return view('scambles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_text' => 'required|string',
            'type' => 'required'
        ]);

        $text = $request->original_text;
        $type = $request->type;
        $result = '';

        switch ($type) {

            case 'reverse':
                $result = strrev($text);
                break;

            case 'shuffle':
                $result = str_shuffle($text);
                break;

            case 'alternate':
                for ($i = 0; $i < strlen($text); $i++) {
                    if ($i % 2 == 0) {
                        $result .= strtoupper($text[$i]);
                    } else {
                        $result .= strtolower($text[$i]);
                    }
                }
                break;

            case 'hash':
                $result = $this->hashScramble($text);
                break;

            case 'base64':
                $result = $this->base64Scramble($text);
                break;

        }

        Scamble::create([
            'original_text' => $text,
            'scamble_text' => $result,
            'type' => $type,
        ]);

        return redirect()->route('scambles.index')
            ->with('success', 'Data Scrambled Successfully!');
    }

    private function hashScramble(string $data): string
    {
        return hash('sha256', $data);
    }
     private function base64Scramble(string $data): string
    {
        return base64_encode($data);
    }
}
