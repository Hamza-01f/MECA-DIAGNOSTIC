@extends('layouts.header')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .card-stats {
            transition: all 0.3s ease;
        }
        
        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }
        
        .status-badge i {
            margin-right: 0.25rem;
        }
        
        .status-complete {
            background-color: #dcfce7;
            color: #15803d;
        }
        
        .status-waiting {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        .status-progress {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .client-avatar {
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            color: white;
            font-weight: 600;
        }
        
        .action-icon {
            padding: 0.375rem;
            border-radius: 9999px;
            transition: all 0.2s ease;
        }
        
        .action-icon:hover {
            transform: scale(1.15);
        }
        
        /* Animation for empty state */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .pulse-animation {
            animation: pulse 2s infinite ease-in-out;
        }
    </style>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800 mb-4 md:mb-0 flex items-center">
            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                <i class="fas fa-stethoscope"></i>
            </span>
            Diagnostics
        </div>
        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4 w-full md:w-auto">
            <form method="GET" action="{{ route('Diagnostics.index') }}" class="relative w-full md:w-64">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm" 
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
            <a href="{{ route('Diagnostics.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-center w-full md:w-auto transition duration-300 shadow-md">
                <i class="fas fa-plus mr-2"></i> Nouveau Diagnostic
            </a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
            <i class="fas fa-filter mr-2 text-blue-500"></i> Filtres
        </h3>
        <form method="GET" action="{{ route('Diagnostics.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Month Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mois</label>
                    <div class="relative">
                        <select name="month" class="w-full border border-gray-300 rounded-lg px-3 py-2 appearance-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les mois</option>
                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <div class="relative">
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 appearance-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les statuts</option>
                            <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                            <option value="en_cours" {{ request('status') == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                            <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Complété</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Client Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                    <div class="relative">
                        <select name="client_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 appearance-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les clients</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Vehicule Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Véhicule</label>
                    <div class="relative">
                        <select name="vehicule_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 appearance-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les véhicules</option>
                            @foreach($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}" {{ request('vehicule_id') == $vehicule->id ? 'selected' : '' }}>
                                    {{ $vehicule->marque }} {{ $vehicule->model }} ({{ $vehicule->matricule }})
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Service Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Service</label>
                    <div class="relative">
                        <select name="service_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 appearance-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tous les services</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end mt-6 space-x-3">
                @if(request()->anyFilled(['month', 'status', 'client_id', 'vehicule_id', 'service_id', 'search']))
                    <a href="{{ route('Diagnostics.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition flex items-center">
                        <i class="fas fa-undo mr-2"></i> Réinitialiser
                    </a>
                @endif
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center shadow-md">
                    <i class="fas fa-filter mr-2"></i> Appliquer
                </button>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Diagnostics Card -->
        <div class="card-stats bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 font-medium">Total Diagnostics</p>
                    <h3 class="text-3xl font-bold mt-2 text-gray-800">{{ $stats['total'] }}</h3>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-stethoscope text-purple-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-1 w-full bg-gray-200 rounded-full">
                    <div class="h-1 bg-purple-500 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>
        
        <!-- En Attente Card -->
        <div class="card-stats bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 font-medium">En Attente</p>
                    <h3 class="text-3xl font-bold mt-2 text-gray-800">{{ $stats['en_attente'] }}</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-clock text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <i class="fas fa-spinner fa-spin mr-2 text-yellow-500"></i>
                <p class="text-yellow-500 text-sm">En traitement</p>
            </div>
            <div class="mt-2">
                <div class="h-1 w-full bg-gray-200 rounded-full">
                    <div class="h-1 bg-yellow-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['en_attente'] / $stats['total'] * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
        
        <!-- Complétés Card -->
        <div class="card-stats bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 font-medium">Complétés</p>
                    <h3 class="text-3xl font-bold mt-2 text-gray-800">{{ $stats['complete'] }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <i class="fas fa-check mr-2 text-green-500"></i>
                <p class="text-green-500 text-sm">Terminés</p>
            </div>
            <div class="mt-2">
                <div class="h-1 w-full bg-gray-200 rounded-full">
                    <div class="h-1 bg-green-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['complete'] / $stats['total'] * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
        
        <!-- En Cours Card -->
        <div class="card-stats bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 font-medium">En cours</p>
                    <h3 class="text-3xl font-bold mt-2 text-gray-800">{{ $stats['en_cours'] }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-cogs text-blue-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <i class="fas fa-tools mr-2 text-blue-500"></i>
                <p class="text-blue-500 text-sm">En progression</p>
            </div>
            <div class="mt-2">
                <div class="h-1 w-full bg-gray-200 rounded-full">
                    <div class="h-1 bg-blue-500 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['en_cours'] / $stats['total'] * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 border border-gray-100">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                <i class="fas fa-list-alt mr-2 text-blue-500"></i> Liste des diagnostics
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            @if($diagnostics->isEmpty())
            <div class="p-16 text-center text-gray-500 pulse-animation">
                <i class="fas fa-stethoscope text-5xl mb-6 text-gray-400"></i>
                <p class="text-xl font-medium mb-4">Aucun diagnostic trouvé</p>
                <p class="text-gray-400 mb-6">Il n'y a pas de diagnostics correspondant à vos critères de recherche.</p>
                @if(request()->anyFilled(['month', 'status', 'client_id', 'vehicule_id', 'service_id', 'search']))
                    <a href="{{ route('Diagnostics.index') }}" class="text-blue-500 hover:text-blue-700 font-medium flex items-center justify-center">
                        <i class="fas fa-undo mr-2"></i> Réinitialiser les filtres
                    </a>
                @endif
            </div>
            @else
            <table class="min-w-full divide-y divide-gray-200" id="diagnosticsTable">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($diagnostics as $diagnostic)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 client-avatar rounded-full flex items-center justify-center">
                                    {{ substr($diagnostic->client->name, 0, 2) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $diagnostic->client->name }}</p>
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-phone-alt mr-1"></i>
                                        {{ $diagnostic->client->phone }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm font-medium text-gray-900">{{ $diagnostic->vehicule->marque }} {{ $diagnostic->vehicule->model }}</p>
                            <p class="text-xs text-gray-500 flex items-center">
                                <i class="fas fa-car mr-1"></i>
                                {{ $diagnostic->vehicule->matricule }}
                            </p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($diagnostic->status === 'complete')  
                                <span class="status-badge status-complete">
                                    <i class="fas fa-check-circle"></i> Complété
                                </span>
                            @elseif($diagnostic->status === 'en_attente') 
                                <span class="status-badge status-waiting">
                                    <i class="fas fa-clock"></i> En Attente
                                </span>
                            @else  
                                <span class="status-badge status-progress">
                                    <i class="fas fa-sync-alt fa-spin"></i> En cours
                                </span>
                            @endif                
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-700 flex items-center">
                                <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                                {{ $diagnostic->date->format('d/m/Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-700 flex items-center">
                                <i class="fas fa-tools mr-2 text-blue-500"></i>
                                {{ $diagnostic->service->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-2">
                                <a href="{{ route('Diagnostics.edit', $diagnostic->id) }}" class="action-icon bg-yellow-100 hover:bg-yellow-200 text-yellow-600" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('Diagnostics.destroy', $diagnostic->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon bg-red-100 hover:bg-red-200 text-red-600" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce diagnostic?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{ route('diagnostics.generate-pdf', $diagnostic->id) }}" class="action-icon bg-green-100 hover:bg-green-200 text-green-600" title="Générer PDF">
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
        @if($diagnostics->hasPages())
        <div class="mt-6 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $diagnostics->appends(['search' => request('search'), 'marque' => request('marque')])->links() }}
        </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        let typingTimer;
        
        searchInput.addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
        
       
        const statsCards = document.querySelectorAll('.card-stats');
        statsCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection