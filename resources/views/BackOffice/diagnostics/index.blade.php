@extends('layouts.header')

@section('content')
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800">Diagnostics</div>
        <div class="flex items-center space-x-4">
            <form method="GET" action="{{ route('Diagnostics.index') }}" class="relative">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Rechercher..."
                >
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                @if(request('search'))
                    <a href="{{ route('Diagnostics.index', array_filter(request()->except('search'))) }}" 
                       class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </form>
            <!-- Add Diagnostic Button -->
            <a href="{{ route('Diagnostics.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouveau Diagnostic
            </a>
        </div>
    </div>
    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <form method="GET" action="{{ route('Diagnostics.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Month Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mois</label>
                    <select name="month" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Tous les mois</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                        <option value="en_cours" {{ request('status') == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                        <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Complété</option>
                    </select>
                </div>
                
                <!-- Client Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                    <select name="client_id" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Tous les clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Vehicule Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Véhicule</label>
                    <select name="vehicule_id" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Tous les véhicules</option>
                        @foreach($vehicules as $vehicule)
                            <option value="{{ $vehicule->id }}" {{ request('vehicule_id') == $vehicule->id ? 'selected' : '' }}>
                                {{ $vehicule->marque }} {{ $vehicule->model }} ({{ $vehicule->matricule }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Service Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                    <select name="service_id" class="w-full border rounded-lg px-3 py-2">
                        <option value="">Tous les services</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end mt-4 space-x-3">
                @if(request()->anyFilled(['month', 'status', 'client_id', 'vehicule_id', 'service_id', 'search']))
                    <a href="{{ route('Diagnostics.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Réinitialiser
                    </a>
                @endif
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Filtrer
                </button>
            </div>
        </form>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Stats Cards -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Total Diagnostics</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $stats['total'] }}</h3>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-stethoscope text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">En Attente</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $stats['en_attente'] }}</h3>
                    <p class="text-yellow-500 text-sm mt-2"><i class="fas fa-spinner"></i> En Traitement</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-clock text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Complétés</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $stats['complete'] }}</h3>
                    <p class="text-green-500 text-sm mt-2"><i class="fas fa-check"></i> Terminés</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">en cours</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $stats['en_cours'] }}</h3>
                    <p class="text-green-500 text-sm mt-2"><i class="fas fa-check"></i> en cours</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="overflow-x-auto">
            @if($diagnostics->isEmpty())
            <div class="p-8 text-center text-gray-500">
                <i class="fas fa-stethoscope text-4xl mb-4"></i>
                <p>Aucun diagnostic trouvé</p>
                @if(request()->anyFilled(['month', 'status', 'client_id', 'vehicule_id', 'service_id', 'search']))
                    <a href="{{ route('Diagnostics.index') }}" class="text-blue-500 hover:text-blue-700 mt-2 inline-block">
                        Réinitialiser les filtres
                    </a>
                @endif
            </div>
            @else
            <table class="min-w-full divide-y divide-gray-200" id="diagnosticsTable">
                <thead>
                    <tr>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($diagnostics as $diagnostic)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">
                                    {{ substr($diagnostic->client->name, 0, 2) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $diagnostic->client->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $diagnostic->client->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-900">{{ $diagnostic->vehicule->marque }} {{ $diagnostic->vehicule->model }}</p>
                            <p class="text-xs text-gray-500">{{ $diagnostic->vehicule->matricule }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($diagnostic->status === 'complete')  
                                <p class="bg-green-100 text-green-800">Complete</p> 
                            @elseif($diagnostic->status === 'en_attente') 
                                <p class="bg-yellow-100 text-yellow-800">En Attente</p> 
                            @else  
                                <p class="bg-blue-100 text-blue-800">En cours</p>
                            @endif                
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $diagnostic->date->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $diagnostic->service->name }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex space-x-2">
                                <a href="{{ route('Diagnostics.edit', $diagnostic->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('Diagnostics.destroy', $diagnostic->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce diagnostic?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('diagnostics.generate-pdf', $diagnostic->id) }}" class="text-green-500 hover:text-green-700" title="PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </div>
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('monthFilter').addEventListener('change', function() {
        const month = this.value;
        window.location.href = "{{ route('Diagnostics.index') }}" + (month ? "?month=" + month : "");
    });

    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#diagnosticsTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });

        
        document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        let typingTimer;
        
        searchInput.addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    });
</script>
@endsection