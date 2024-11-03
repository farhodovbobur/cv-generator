<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'nt_id'         => ['nullable', 'numeric', 'unique:' . Student::class],
            'first_name'    => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'middle_name'   => ['nullable', 'string'],
            'gender'        => ['nullable', 'in:male,female'],
            'date_of_birth' => ['nullable', 'date'],
            'phone'         => ['nullable', 'numeric'],
            'email'         => ['nullable', 'email'],
            'bio'           => ['nullable', 'string'],
            'image'         => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }
}
