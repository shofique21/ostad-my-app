<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catregory extends Model
{
    protected $fillable = ['name', 'slug', 'is_active'];

    public function vehiles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
