<?php

namespace App\Http\Controllers;

use App\Models\Diagnostics;
use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Service;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosticsController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $search = $request->input('search');
        $status = $request->input('status');
        $client_id = $request->input('client_id');
        $vehicule_id = $request->input('vehicule_id');
        $service_id = $request->input('service_id');
        
        $diagnostics = Diagnostics::with(['client', 'vehicule', 'service'])
            ->when($month, function($query) use ($month) {
                $query->whereMonth('date', $month);
            })
            ->when($search, function($query) use ($search) {
                $query->whereHas('client', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('vehicule', function($q) use ($search) {
                    $q->where('marque', 'like', "%{$search}%")
                      ->orWhere('model', 'like', "%{$search}%")
                      ->orWhere('matricule', 'like', "%{$search}%");
                })
                ->orWhereHas('service', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->when($status, function($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($client_id, function($query) use ($client_id) {
                $query->where('client_id', $client_id);
            })
            ->when($vehicule_id, function($query) use ($vehicule_id) {
                $query->where('vehicule_id', $vehicule_id);
            })
            ->when($service_id, function($query) use ($service_id) {
                $query->where('service_id', $service_id);
            })
            ->orderBy('date', 'desc')
            ->get();
        
    
        $stats = [
            'total' => Diagnostics::count(),
            'en_attente' => Diagnostics::where('status', 'en_attente')->count(),
            'complete' => Diagnostics::where('status', 'complete')->count(),
            'en_cours' => Diagnostics::where('status', 'en_cours')->count(),
        ];
        
       
        $clients = Client::orderBy('name')->get();
        $vehicules = Vehicule::orderBy('marque')->get();
        $services = Service::orderBy('name')->get();
        
        return view('BackOffice.diagnostics.index', compact(
            'diagnostics', 
            'stats',
            'clients',
            'vehicules',
            'services'
        ));
    }

    public function create()
    {
        $clients = Client::all();
        $vehicules = Vehicule::all();
        $services = Service::all();
        return view('BackOffice.diagnostics.create', compact('clients', 'vehicules', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'vehicule_id' => 'required|exists:vehicules,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'status' => 'required|in:en_attente,complete,en_cours',
        ]);

        
        $diagnostic = Diagnostics::create($validated);

        return redirect()->route('Diagnostics.index')->with('success', 'Diagnostic updated successfully');

    }

    public function show(Diagnostics $diagnostic)
    {
        return view('BackOffice.diagnostics.index', compact('diagnostic'));
    }

    public function edit(Diagnostics $diagnostic)
    {
        $clients = Client::all();
        $vehicules = Vehicule::all();
        $services = Service::all();
        return view('BackOffice.diagnostics.update', compact('diagnostic', 'clients', 'vehicules', 'services'));
    }

    public function update(Request $request, Diagnostics $diagnostic)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'vehicule_id' => 'required|exists:vehicules,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'status' => 'required|in:en_attente,complete,en_cours',
        ]);

        $diagnostic->update($validated);

        return redirect()->route('Diagnostics.index')->with('success', 'Diagnostic updated successfully');
    }

    public function destroy(Diagnostics $diagnostic)
    {
        $diagnostic->delete();
        return redirect()->route('Diagnostics.index')->with('success', 'Diagnostic deleted successfully');
    }

    public function generatePdf(Diagnostics $diagnostic)
    {
     
        $diagnostic->load(['client', 'vehicule', 'service']);
        
        if (!$diagnostic->client || !$diagnostic->vehicule || !$diagnostic->service) {
            abort(404, 'Related records not found for this diagnostic');
        }
        
        $pdf = Pdf::loadView('BackOffice.pdf', compact('diagnostic'));
        return $pdf->download('diagnostic-'.$diagnostic->id.'-'.now()->format('Y-m-d').'.pdf');
    }
}