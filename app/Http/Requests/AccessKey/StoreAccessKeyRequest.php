<?php

namespace App\Http\Requests\AccessKey;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccessKeyRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','min:5','max:50','regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'],
            'description' => ['nullable','max:255','regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'],
            'limit_traffic' => ['nullable','integer','min:1'],
            'expire_at' => ['required','integer'],
        ];
    }
}
