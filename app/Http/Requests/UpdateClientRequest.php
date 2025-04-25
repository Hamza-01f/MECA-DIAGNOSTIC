<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest{
    
    public function authorize(){
          return true;
    }

    public function rules(){

        $client = $this->route('client');
        
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|unique:clients,phone,' . $client->id,
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'address' => 'nullable|string',
            'city' => 'nullable|string',
        ];
    }

    public function messages(){

        return[
            'name.required' => 'Le nom est obligatoire',
            'name.string' => 'Veuillez entrer un nom valide',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'phone.required' => 'Veuillez entrer un numéro de téléphone',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Veuillez entrer un email valide',
            'email.unique' => 'Cet email est déjà utilisé',
            'address.string' => 'L\'adresse doit être une chaîne de caractères',
            'city.string' => 'La ville doit être une chaîne de caractères',
        ];

    }
}