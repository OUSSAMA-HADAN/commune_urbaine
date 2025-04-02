<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderMissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change if you have authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'dateDebut' => 'required|date|before_or_equal:dateFin|before_or_equal:dateAriver',
            'dateAriver' => 'required|date|after_or_equal:dateDebut|before_or_equal:dateFin',
            'dateFin' => 'required|date|after_or_equal:dateDebut|after_or_equal:dateAriver',
            'destination' => 'required|string|max:255',
            'transport' => 'required|string|max:255',
            'objectif' => 'required|string|max:500',
            'idFonctionnaire' => 'required|exists:users,id',
            'etatRemboursement' => 'nullable|default:Approved',
            'file_path' => 'max:2048'

        ];
    }

    /**
     * Custom error messages (Optional)
     */
    public function messages(): array
    {
        return [
            'dateDebut.required' => 'La date de début est obligatoire.',
            'dateDebut.date' => 'La date de début doit être une date valide.',
            'dateDebut.before_or_equal' => 'La date de début doit être avant ou égale à la date d’arrivée et à la date de fin.',

            'dateAriver.required' => 'La date d’arrivée est obligatoire.',
            'dateAriver.date' => 'La date d’arrivée doit être une date valide.',
            'dateAriver.after_or_equal' => 'La date d’arrivée doit être égale ou postérieure à la date de début.',
            'dateAriver.before_or_equal' => 'La date d’arrivée doit être avant ou égale à la date de fin.',

            'dateFin.required' => 'La date de fin est obligatoire.',
            'dateFin.date' => 'La date de fin doit être une date valide.',
            'dateFin.after_or_equal' => 'La date de fin doit être égale ou postérieure à la date de début et à la date d’arrivée.',

            'destination.required' => 'La destination est obligatoire.',
            'destination.string' => 'La destination doit être une chaîne de caractères.',
            'destination.max' => 'La destination ne peut pas dépasser 255 caractères.',

            'objectif.required' => 'L\'objectif est obligatoire.',
            'objectif.string' => 'L\'objectif doit être une chaîne de caractères.',
            'objectif.max' => 'L\'objectif ne peut pas dépasser 500 caractères.',

            'idFonctionnaire.required' => 'L’utilisateur est requis.',
            'idFonctionnaire.exists' => 'L’utilisateur sélectionné est invalide.',

            'etatRemboursement.nullable' => 'L\'état de remboursement est facultatif.',

            'file_path.max' => 'Le fichier ne doit pas dépasser 2 Mo.',
        ];
    }
}
