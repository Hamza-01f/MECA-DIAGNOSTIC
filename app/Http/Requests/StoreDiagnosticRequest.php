<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosticRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'vehicule_id' => 'required|exists:vehicules,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'status' => 'required|in:en_attente,complete,en_cours',
        ];
    }

    public function messages(){
        return [
            'client_id.required' => 'Le champ client est obligatoire.',
            'client_id.exists' => 'Le client sélectionné est invalide.',
            'vehicule_id.required' => 'Le champ véhicule est obligatoire.',
            'vehicule_id.exists' => 'Le véhicule sélectionné est invalide.',
            'service_id.required' => 'Le champ service est obligatoire.',
            'service_id.exists' => 'Le service sélectionné est invalide.',
            'date.required' => 'Le champ date est obligatoire.',
            'date.date' => 'La date doit être une date valide.',
            'status.required' => 'Le champ statut est obligatoire.',
            'status.in' => 'Le statut sélectionné est invalide.',
        ];
    }
}
