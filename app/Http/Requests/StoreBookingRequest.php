<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'resource_id' => 'required|exists:resources,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date|date_format:Y-m-d',
            'end_time' => 'required|date|date_format:Y-m-d|after:start_time',
        ];
    }
    public function messages(): array
    {
        return [
            'resource_id.required' => 'Поле с ресурсом обязательно для заполнения.',
            'resource_id.exists' => 'Выбранный ресурс не существует в базе.',
            'user_id.required' => 'Поле с пользователем обязательно для заполнения.',
            'user_id.exists' => 'Указанный пользователь не найден.',
            'start_time.required' => 'Поле с временем начала обязательно для заполнения.',
            'start_time.date' => 'Укажите правильную дату для времени начала.',
            'start_time.date_format' => 'Формат времени начала должен быть в формате Y-m-d (например, 2025-01-01).',
            'end_time.required' => 'Поле с временем окончания обязательно для заполнения.',
            'end_time.date' => 'Укажите правильную дату для времени окончания.',
            'end_time.date_format' => 'Формат времени окончания должен быть в формате Y-m-d (например, 2025-01-01).',
            'end_time.after' => 'Время окончания должно быть позже времени начала.',
        ];
    }
}
