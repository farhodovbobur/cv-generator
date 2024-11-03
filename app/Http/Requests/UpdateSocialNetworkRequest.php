<?php

namespace App\Http\Requests;

use App\Models\SocialNetwork;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialNetworkRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'unique:' . SocialNetwork::class],
            'url'  => ['nullable', 'url', 'unique:' . SocialNetwork::class]
        ];
    }
}
