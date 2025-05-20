<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidatProfileRequest extends FormRequest
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
            'nom_candidat' => 'required|string|max:100|min:3',
            'prenom_candidat' => 'required|string|max:100|min:3',
            'number' => [
                'nullable',
                'regex:/^\d{10}$/',
            ],
            // 'statut'=> 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'nom_candidat.required'    => 'The last name is required.',
            'nom_candidat.string'      => 'The last name must be a valid string.',
            'nom_candidat.max'         => 'The last name must not exceed 100 characters.',

            'prenom_candidat.required' => 'The first name is required.',
            'prenom_candidat.string'   => 'The first name must be a valid string.',
            'prenom_candidat.max'      => 'The first name must not exceed 100 characters.',

            'number.string'            => 'The phone number must be a string.',
            'number.max'               => 'The phone number must not exceed 20 characters.',
            'number.regex'             => 'The phone number must be a valid number.',

            'photo.image'              => 'The profile photo must be an image.',
            'photo.mimes'              => 'The profile photo must be in one of the following formats: jpeg, png, jpg, gif.',
            'photo.max'                => 'The profile photo must not be larger than 2MB.',
        ];
    }
}
