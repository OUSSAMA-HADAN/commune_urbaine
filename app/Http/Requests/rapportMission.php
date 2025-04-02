<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class rapportMission extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Assuming you handle authorization through middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sujet' => 'required|string|max:255',
            'contenu' => 'required|string',
            'dateSoumission' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sujet.required' => 'Le sujet du rapport est requis.',
            'sujet.max' => 'Le sujet ne peut pas dépasser 255 caractères.',
            'contenu.required' => 'Le contenu du rapport est requis.',
            'dateSoumission.required' => 'La date de soumission est requise.',
            'dateSoumission.date' => 'La date de soumission doit être une date valide.',
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
        ];
    }
}
