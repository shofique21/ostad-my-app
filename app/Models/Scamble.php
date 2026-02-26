<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scamble extends Model
{
    protected $fillable = [
        'original_text',
        'scamble_text',
        'type'
    ];
}
