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
    public function index()
    {
        $diagnostics = Diagnostics::with(['client', 'vehicule', 'service'])->get();
     
        return view('BackOffice.diagnostics.index', compact('diagnostics'));
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
            'status' => 'required|in:en_attente,complete',
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
            'status' => 'required|in:en_attente,complete',
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