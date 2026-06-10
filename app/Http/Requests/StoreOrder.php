<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'contact' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
                    $digits = preg_replace('/\D/', '', $value);
                    $isPhone = preg_match('/^(7|8)\d{10}$/', $digits);
                    
                    if (!$isEmail && !$isPhone) {
                        $fail('Введите корректный E-mail или российский номер телефона.');
                    }
                },
            ],
            'message' => ['required', 'string', 'max:5000'],
            'service_type' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Укажите ваше имя.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            'contact.required' => 'Укажите контактный телефон или e-mail.',
            'contact.max' => 'Контактные данные не должны превышать 255 символов.',
            'message.required' => 'Напишите сообщение.',
            'message.max' => 'Сообщение слишком длинное (максимум 5000 символов).',
        ];
    }
}
