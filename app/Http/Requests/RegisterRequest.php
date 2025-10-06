<?php

namespace App\Http\Requests;

use App\DTOs\RegisterDTO;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                $isUserActive =  User::where('username', $value)->whereHas('accessLinks', function ($query) {
                    $query->where('expires_at', '>', now());
                })->exists();
                
                if ($isUserActive) {
                    $fail('Користувач з таким ім\'ям вже активний');
                }
            }],
            'phonenumber' => ['required', 'string', 'regex:/^\+?[0-9]{10}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Поле Username обов\'язкове для заповнення',
            'phonenumber.required' => 'Поле Phone Number обов\'язкове для заповнення',
            'phonenumber.regex' => 'Номер телефону повинен бути в міжнародному форматі (наприклад: +1234567890)',
        ];
    }

    public function getDTO(): RegisterDTO
    {
        return new RegisterDTO($this->username, $this->phonenumber);
    }
}
