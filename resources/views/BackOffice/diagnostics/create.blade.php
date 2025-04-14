@extends('layouts.header')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
            {{ isset($diagnostic) ? 'Modifier Diagnostic' : 'Nouveau Diagnostic' }}
        </h2>
        
        <form action="{{ isset($diagnostic) ? route('Diagnostics.update', $diagnostic->id) : route('Diagnostics.store') }}" method="POST">
            @csrf
            @if(isset($diagnostic))
                @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Client</label>
                    <select name="client_id" id="client_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" 
                                {{ (isset($diagnostic) && $diagnostic->client_id == $client->id) ? 'selected' : '' }}>
                                {{ $client->name }} - {{ $client->phone }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
               
                <div>
                    <label class="block text-sm font-medium text-gray-700">Véhicule</label>
                    <select name="vehicule_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Sélectionner un véhicule</option>
                        @foreach($clients as $client)
                            
                                @foreach($client->vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}">
                                        {{ $vehicule->marque }} {{ $vehicule->model }} - {{ $vehicule->matricule }}
                                    </option>
                                @endforeach
                           
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type de Service</label>
                    <select name="service_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Sélectionner un service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" 
                                {{ (isset($diagnostic) && $diagnostic->service_id == $service->id) ? 'selected' : '' }}>
                                {{ $service->name }} ({{ $service->price }} DH)
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" value="{{ isset($diagnostic) ? $diagnostic->date->format('Y-m-d') : now()->format('Y-m-d') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Statut</label>
                    <select name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="en_attente" {{ (isset($diagnostic) && $diagnostic->status == 'en_attente') ? 'selected' : '' }}>En Attente</option>
                        <option value="complete" {{ (isset($diagnostic) && $diagnostic->status == 'complete') ? 'selected' : '' }}>Complété</option>
                    </select>
                </div>
                    
            </div>
            
            <div class="flex justify-end space-x-3">
                <a href="{{ route('Diagnostics.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Annuler
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ isset($diagnostic) ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Dynamic vehicle loading based on client selection
    document.getElementById('client_id').addEventListener('change', function() {
        const clientId = this.value;
        const vehicleSelect = document.getElementById('vehicule_id');
        
        // Clear existing options
        vehicleSelect.innerHTML = '<option value="">Sélectionner un véhicule</option>';
        
        if (clientId) {
            // Fetch vehicles for the selected client
            fetch(`/api/clients/${clientId}/vehicles`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(vehicle => {
                        const option = document.createElement('option');
                        option.value = vehicle.id;
                        option.textContent = `${vehicle.marque} ${vehicle.model} - ${vehicle.matricule}`;
                        vehicleSelect.appendChild(option);
                    });
                });
        }
    });
</script>
@endsection