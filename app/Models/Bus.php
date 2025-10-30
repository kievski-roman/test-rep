<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model {
    protected $fillable = ['number_bus', 'car_brand_id', 'driver_id'];

    public function setNumberBusAttribute($value) {
        $this->attributes['number_bus'] = strtoupper($value);
    }

    public function carBrand() { return $this->belongsTo(CarBrand::class); }
    public function driver() { return $this->belongsTo(Driver::class); }
}
