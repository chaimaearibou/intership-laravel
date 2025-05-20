<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
            'offre_id' => ['required', 'exists:offres,offre_id'],
            'cv' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'lettre_motivation' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ];
    }

    public function messages(): array
    {
    return [
        'offre_id.required' => 'The job offer is required.',
        'offre_id.exists' => 'The selected job offer does not exist.',
        'cv.required' => 'The CV is required.',
        'cv.mimes' => 'The CV must be in PDF format.',
        'lettre_motivation.required' => 'The cover letter is required.',
        'lettre_motivation.mimes' => 'The cover letter must be in PDF format.',
        ];
    }

}
