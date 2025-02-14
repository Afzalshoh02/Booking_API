<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResourceRequest extends FormRequest
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
            'name' => 'required|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле "название" обязательно для заполнения.',
            'type.required' => 'Поле "тип" обязательно для заполнения.',
        ];
    }
}
