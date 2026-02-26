<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataScamble extends Model
{
    protected $fillable = ['original_text','scamble_data','scamble_type'];
}
