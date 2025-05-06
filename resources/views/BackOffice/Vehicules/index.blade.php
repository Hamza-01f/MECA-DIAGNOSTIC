@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8 bg-gray-50 min-h-screen">
        <!-- Page Header with Gradient Background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <h1 class="text-3xl font-bold text-white">Gestion des Véhicules</h1>
                
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <!-- Search Form with Improved Styling -->
                    <form method="GET" action="{{ route('vehicules.index') }}" class="relative w-full md:w-64">
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-10 py-2.5 border-none rounded-lg bg-white/90 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-300 text-gray-700" 
                            placeholder="Rechercher un véhicule..."
                        >
                        <i class="fas fa-search absolute left-3 top-3 text-blue-500"></i>
                        @if(request('search'))
                            <a href="{{ route('vehicules.index', ['marque' => request('marque')]) }}" 
                               class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </form>
                    
                    <!-- Brand Filter with Improved Styling -->
                    <form method="GET" action="{{ route('vehicules.index') }}" class="w-full md:w-auto">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select 
                            name="marque" 
                            class="w-full md:w-auto border-none rounded-lg px-4 py-2.5 bg-white/90 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-300 text-gray-700"
                            onchange="this.form.submit()"
                        >
                            <option value="">Toutes les Marques</option>
                            @foreach($marques as $marqueOption)
                                <option value="{{ $marqueOption }}" {{ request('marque') == $marqueOption ? 'selected' : '' }}>
                                    {{ $marqueOption }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                
                <!-- Add Vehicle Button -->
                <button onclick="openModal()" class="w-full md:w-auto flex items-center justify-center bg-white text-blue-600 px-5 py-2.5 rounded-lg hover:bg-blue-50 font-medium shadow-md transition-all transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i> Nouveau Véhicule
                </button>
            </div>
        </div>

        <!-- Vehicle Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all transform hover:scale-102 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm uppercase tracking-wider">Total Véhicules</p>
                        <h3 class="text-3xl font-bold text-blue-600 mt-1">{{ $vehicules->count() }}</h3>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full shadow-inner">
                        <i class="fas fa-car-alt text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all transform hover:scale-102 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm uppercase tracking-wider">Véhicules à jour</p>
                        <h3 class="text-3xl font-bold text-green-600 mt-1">{{ $vehicules->where('days_until_service', '>', 0)->count() }}</h3>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full shadow-inner">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all transform hover:scale-102 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm uppercase tracking-wider">Maintenance Requise</p>
                        <h3 class="text-3xl font-bold text-yellow-600 mt-1">{{ $vehicules->where('days_until_service', '<=', 0)->count() }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-full shadow-inner">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicles List -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8 border border-gray-100">
            @if($vehicules->isEmpty())
                <div class="p-12 text-center">
                    <div class="bg-gray-100 inline-flex p-6 rounded-full mb-4">
                        <i class="fas fa-car-alt text-4xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-600 text-lg mb-3">Aucun véhicule trouvé</p>
                    @if(request('search') || request('marque'))
                        <a href="{{ route('vehicules.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
                            <i class="fas fa-redo mr-2"></i> Réinitialiser les filtres
                        </a>
                    @endif
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Propriétaire</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matricule</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marque/Modèle</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kilométrage</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernière visite</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service type</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jours restants</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($vehicules as $vehicule)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-medium">
                                            {{ substr($vehicule->client->name, 0, 2) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $vehicule->client->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">
                                        {{ $vehicule->matricule }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $vehicule->marque }}</div>
                                    <div class="text-sm text-gray-500">{{ $vehicule->model }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 font-medium">{{ number_format($vehicule->kilometrage, 0, ',', ' ') }}</div>
                                    <div class="text-xs text-gray-500">kilomètres</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $vehicule->last_visit->format('d/m/Y') }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-sm">
                                        {{ $vehicule->service->name }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm">
                                    <div class="font-medium {{ $vehicule->days_until_service > 0 ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ $vehicule->days_until_service }} Jour{{ $vehicule->days_until_service != 1 ? 's' : '' }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($vehicule->days_until_service > 0)
                                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800 font-medium">
                                            <i class="fas fa-check-circle mr-1"></i> À jour
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-medium">
                                            <i class="fas fa-exclamation-triangle mr-1"></i> Maintenance requise
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('vehicules.edit', $vehicule->id) }}" class="text-amber-500 hover:text-amber-700 transition-colors" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        @if($vehicules->hasPages())
        <div class="mt-6 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $vehicules->appends(['search' => request('search'), 'marque' => request('marque')])->links() }}
        </div>
        @endif
    </div>

    <!-- Add Vehicle Modal with Improved Design -->
    <div id="addVehicleModal" class="fixed inset-0 bg-black bg-opacity-60 overflow-y-auto hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="relative mx-auto p-6 w-full max-w-3xl bg-white rounded-xl shadow-2xl transform transition-all animate-fadeIn">
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800">Ajouter un nouveau véhicule</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('vehicules.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Propriétaire</label>
                        <select name="client_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('client_id') border-red-500 @enderror">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Matricule</label>
                        <input type="text" name="matricule" value="{{ old('matricule') }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('matricule') border-red-500 @enderror">
                        @error('matricule')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Marque</label>
                        <input type="text" name="marque" value="{{ old('marque') }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('marque') border-red-500 @enderror">
                        @error('marque')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Modèle</label>
                        <input type="text" name="model" value="{{ old('model') }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('model') border-red-500 @enderror">
                        @error('model')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Kilométrage</label>
                        <div class="relative">
                            <input type="number" name="kilometrage" value="{{ old('kilometrage') }}" 
                                class="w-full border border-gray-300 rounded-lg pl-4 pr-16 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kilometrage') border-red-500 @enderror">
                            <span class="absolute right-3 top-2.5 text-gray-500">km</span>
                        </div>
                        @error('kilometrage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Jour du visite</label>
                        <input type="date" name="last_visit" value="{{ old('last_visit') }}" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('last_visit') border-red-500 @enderror">
                        @error('last_visit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">Type de service</label>
                        <select name="service_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('service_id') border-red-500 @enderror">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeModal()" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors">
                        <i class="fas fa-times mr-2"></i> Annuler
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors">
                        <i class="fas fa-save mr-2"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
           
    </div>
 
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
        
        .hover\:scale-102:hover {
            transform: scale(1.02);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <script>
        function openModal() {
            const modal = document.getElementById('addVehicleModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.querySelector('.bg-white').classList.add('animate-fadeIn');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('addVehicleModal');
            modal.classList.add('hidden');
            modal.querySelector('.bg-white').classList.remove('animate-fadeIn');
        }

       
        document.getElementById('addVehicleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endsection