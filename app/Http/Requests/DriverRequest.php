<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverRequest extends FormRequest
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
        $maxBirth = now()->subYears(65)->toDateString();

        $id = $this->route('id') ?? $this->input('id');

        return [
            'first_name' => ['required','string','min:2','max:100'],
            'last_name'  => ['required','string','min:2','max:100'],
            'birth_date' => ["required","date","after_or_equal:{$maxBirth}"],
            'salary'     => ['required','numeric','min:0'],
            'email'      => [
                'required','email','max:255',
                Rule::unique('drivers','email')->ignore($id),
            ],
            'photo'           => ['nullable','array'],
            'photo.*.text'    => ['nullable','string','max:255'],
            'photo.*.src'     => ['nullable','url'],
        ];
    }
}
