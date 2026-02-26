<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataScamble;
class ScambleController extends Controller
{
    public function allScamble()
    {
        $scambleText = DataScamble::all();

        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => $scambleText
        ], 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'original_text' => 'required|string',
            'scamble_type' => 'required'
        ]);
       
        $data = $request->original_text;
        $type = $request->scamble_type;
        $result = '';
       
        switch ($type) {

            case 'reverse':
                $result = strrev($data);
                break;

            case 'shuffle':
                $result = str_shuffle($data);
                break;

            case 'alternate':
                for ($i = 0; $i < strlen($data); $i++) {
                    if ($i % 2 == 0) {
                        $result .= strtoupper($data[$i]);
                    } else {
                        $result .= strtolower($data[$i]);
                    }
                }
                break;

            case 'hash':
                $result = $this->hashScramble($data);
                break;

            case 'base64':
                $result = $this->base64Scramble($data);
                break;

        }
      
      $scamble =  DataScamble::create([
            'original_text' => $data,
            'scamble_data' => $result,
            'scamble_type' => $type,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data created successfully',
            'data' => $scamble
        ], 201);
    }

      private function hashScramble(string $data): string
    {
        return hash('sha256', $data);
    }

    private function base64Scramble(string $data)
    {
         return base64_encode($data);
    }
}
