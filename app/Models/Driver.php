<?php

namespace App\Models;

use App\Jobs\SendFarewellEmail;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use CrudTrait, SoftDeletes;
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'images',
        'salary',
        'email'
    ];



    protected $casts = ['images' => 'array', 'birth_date' => 'date'];

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
    public function scopeActive($q) { return $q->whereNull('deleted_at'); }
    public function scopeFormer($q) { return $q->onlyTrashed(); }
    public function bus()
    {
        return $this->hasOne(Bus::class);
    }

    protected static function booted(): void
    {
        static::deleted(function (Driver $driver) {
            SendFarewellEmail::dispatch([
                'email' => $driver->email,
                'name'  => $driver->first_name.' '.$driver->last_name,
            ])->delay(now()->addSeconds(5));
        });
    }

}
