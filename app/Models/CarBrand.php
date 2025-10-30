<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use CrudTrait;
    protected $fillable = ['name'];
}
