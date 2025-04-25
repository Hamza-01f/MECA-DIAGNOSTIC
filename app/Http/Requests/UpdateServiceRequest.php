<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'type' => 'required|in:quick,long',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'period' => 'required|integer|min:1',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Le nom du service est obligatoire.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'type.required' => 'Le type de service est obligatoire.',
            'type.in' => 'Le type de service doit être "rapide" ou "long".',
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix ne peut pas être négatif.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être de type: jpeg, png, jpg ou gif.',
            'image.max' => 'L\'image ne doit pas dépasser 2MB.',
            'period.required' => 'La période est obligatoire.',
            'period.integer' => 'La période doit être un nombre entier.',
            'period.min' => 'La période doit être d\'au moins 1 jour.',
        ];
    }
}
