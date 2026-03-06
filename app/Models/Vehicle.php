<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'brand', 'model',
        'year', 'condition', 'milage', 'fuel_type', 'transmission',
        'description', 'location', 'contact_number', 'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Catregory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }
}
