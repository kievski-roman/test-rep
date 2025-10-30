<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number_bus' => 'required|string|max:20|unique:buses,number_bus',
            'car_brand_id' => 'required|exists:car_brands,id',
            'driver_id' => 'nullable|exists:drivers,id',
        ];
    }
}
