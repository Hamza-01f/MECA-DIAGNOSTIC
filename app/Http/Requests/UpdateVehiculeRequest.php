<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehiculeRequest extends FormRequest
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
            'matricule' => [
                'required',
                'max:20',
                Rule::unique('vehicules')->ignore($this->vehicule),
            ],
            'marque' => 'required|max:200',
            'model' => 'required|max:100',
            'kilometrage' => 'required|integer|min:0',
            'last_visit' => 'required|date|before_or_equal:today',
            'service_id' => 'required|exists:services,id',
        ];
    }


    public function messages(){
        return [
            'client_id.required' => 'Le champ propriétaire est obligatoire.',
            'client_id.exists' => 'Le propriétaire sélectionné est invalide.',
            'matricule.required' => 'Le champ matricule est obligatoire.',
            'matricule.max' => 'Le matricule ne doit pas dépasser :max caractères.',
            'matricule.unique' => 'Ce matricule est déjà utilisé.',
            'marque.required' => 'Le champ marque est obligatoire.',
            'marque.max' => 'La marque ne doit pas dépasser :max caractères.',
            'model.required' => 'Le champ modèle est obligatoire.',
            'model.max' => 'Le modèle ne doit pas dépasser :max caractères.',
            'kilometrage.required' => 'Le champ kilométrage est obligatoire.',
            'kilometrage.integer' => 'Le kilométrage doit être un nombre entier.',
            'kilometrage.min' => 'Le kilométrage ne peut pas être négatif.',
            'last_visit.required' => 'Le champ date de dernière visite est obligatoire.',
            'last_visit.date' => 'La date de dernière visite doit être une date valide.',
            'last_visit.before_or_equal' => 'La date de dernière visite ne peut pas être dans le futur.',
            'service_id.required' => 'Le champ type de service est obligatoire.',
            'service_id.exists' => 'Le type de service sélectionné est invalide.',
        ];
    }
}
