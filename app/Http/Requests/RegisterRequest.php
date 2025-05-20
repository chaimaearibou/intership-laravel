<?php

namespace App\Http\Requests;

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
            'nom' => 'required|string|max:255|min:3',
            'prenom' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function messages(): array
{
    return [
        'nom.required' => 'The last name is required.',
        'nom.string' => 'The last name must be a valid string.',
        'nom.max' => 'The last name may not be greater than 255 characters.',

        'prenom.required' => 'The first name is required.',
        'prenom.string' => 'The first name must be a valid string.',
        'prenom.max' => 'The first name may not be greater than 255 characters.',

        'email.required' => 'The email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',

        'password.required' => 'The password is required.',
        'password.confirmed' => 'The password confirmation does not match.',
        'password.min' => 'The password must be at least 6 characters.',
    ];
}

}
