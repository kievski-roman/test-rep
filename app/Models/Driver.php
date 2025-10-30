<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['first_name', 'last_name', 'birth_date', 'photo'];

    protected $casts = ['photo' => 'array', 'birth_date' => 'date'];

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtolower($value);
    }


    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function ($driver) {
            if ($driver->birth_date->age > 65) {
                throw new \Exception('Водій не може бути старше 65 років');
            }
        });
    }
}
