<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\User;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
  
    public function index(Request $request)
    {
        $search = $request->input('search');
        $marque = $request->input('marque');
 
        $vehicules = Vehicule::with(['client', 'service'])
        ->when($search, function($query,$search){
               return $query->where('matricule','like',"%{$search}%")
                            ->orWhere('model','like',"%{$search}%")
                            ->orWhere('marque','like',"%{$search}%")
                            ->orWhereHas('client',function($q) use ($search){
                                $q->where('name','like',"%{$search}%");
                            });
            
        })
        ->when($marque, function($query, $marque){
            return $query->where('marque',$marque);
        })
        
        ->get();


        $clients = Client::all(); 
        $services = Service::all();
        $marques = Vehicule::select('marque')->distinct()->pluck('marque');
  
        return view('BackOffice.Vehicules.index', compact('vehicules', 'clients', 'services','marques'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => '',
            'matricule' => '',
            'marque' => '',
            'model' => '',
            'kilometrage' => '',
            'last_visit' => '',
            'service_id' => '',
        ]);
        
        $service = Service::find($validated['service_id']);
        $validated['service_period'] = $service->period;
        
        $vehicule = Vehicule::create($validated);
        
        
        $vehicule->calculateDaysUntilService();
    
        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté avec succès!');
    }
    public function edit(Vehicule $vehicule)
    {
        $clients = Client::all();
        $services = Service::all();
        return view('BackOffice.Vehicules.update', compact('vehicule', 'clients', 'services'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'matricule' => 'required|max:20|unique:vehicules,matricule,'.$vehicule->id,
            'marque' => 'required|max:200',
            'model' => 'required|max:100',
            'kilometrage' => 'required|integer',
            'last_visit' => 'required|date',
            'service_id' => 'required|exists:services,id',
        ]);
    
        $service = Service::find($validated['service_id']);
        $validated['service_period'] = $service->period;
    
        $vehicule->update($validated);
        
        $vehicule->calculateDaysUntilService();
    
        return redirect()->route('vehicules.index')->with('success', 'Véhicule modifié avec succès!');    }

    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé avec succès!');
    }
}