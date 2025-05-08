<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Offrerequest extends FormRequest
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
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'localisation' => 'required|string',
            'duration' => 'required|integer|min:1',
            'creer_par' => 'required|integer|exists:utilisateurs,utilisateur_id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut', 
            'type' => 'required|string',
        ];
    }
     /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages():array{
        return[
            'titre.required'=>'The title is required',
            'titre.string'=>'The title must be a string',
            'titre.max'=>'The title must not exceed 255 characters',
            'description.required'=>'The description is required',
            'description.string'=>'The description must be a string',
            'localisation.required'=>'The location is required',
            'duration.required'=>'The duration is required',
            'duration.integer'=>'The duration must be an integer',
            'duration.min'=>'The duration must be at least 1',
            'creer_par.required'=>'The creator is required',
            'date_debut.required'=>'The start date is required',
            'date_debut.date'=>'The start date must be a valid date',
            'date_fin.required'=>'The end date is required',
            'date_fin.date'=>'The end date must be a valid date',
            'date_fin.after'=>'The end date must be after the start date',
            'type.required'=>'The type is required',
        ];
    }
}
