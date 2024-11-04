<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
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
            'student_id'  => ['required', 'integer', 'exists:students,id'],
            'name'        => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'start_date'  => ['nullable', 'date'],
            'end_date'    => ['nullable', 'date'],
        ];
    }
}
