<?php

namespace App\Http\Controllers;

use App\Models\DataScamble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
class DataScamblerController extends Controller
{
    public function index()
    {
        $scambleData = DataScamble::all();
        return view('datascamble.index', compact('scambleData'));
    }

    public function create()
    {
        return view('datascamble.create');
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

        DataScamble::create([
            'original_text' => $data,
            'scamble_data' => $result,
            'scamble_type' => $type,
        ]);

        return redirect()->route('data.scambles.index')
            ->with('success', 'Data Scrambled Successfully!');
            
    }

    private function hashScramble(string $data): string
    {
        return hash('sha256', $data);
    }

    private function base64Scramble(string $data)
    {
        return base64_encode($data);
    }





    public function scambleDataShow()
    {
        // Call your API
        $request = Request::create('/api/scamble-text', 'GET');
        $response = Route::dispatch($request);

        $data = json_decode($response->getContent(), true);
       
       return view('datascamble.data-view', ['scambles' => $data['data'] ?? $data]);
    }

}
