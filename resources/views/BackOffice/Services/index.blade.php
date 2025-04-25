@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8 bg-gray-50 min-h-screen">
        <!-- Page Header with Gradient Background -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <h1 class="text-3xl font-bold text-white">Gestion des Services</h1>
                
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <!-- Search Form with Improved Styling -->
                    <form method="GET" action="{{ route('services.index') }}" class="relative w-full md:w-64">
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-10 py-2.5 border-none rounded-lg bg-white/90 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-300 text-gray-700" 
                            placeholder="Rechercher un service..."
                        >
                        <i class="fas fa-search absolute left-3 top-3 text-blue-500"></i>
                        @if(request('search'))
                            <a href="{{ route('services.index', ['type' => request('type')]) }}" 
                               class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </form>
                    
                    <!-- Type Filter with Improved Styling -->
                    <form method="GET" action="{{ route('services.index') }}" class="w-full md:w-auto">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select 
                            name="type" 
                            class="w-full md:w-auto border-none rounded-lg px-4 py-2.5 bg-white/90 backdrop-blur-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-300 text-gray-700"
                            onchange="this.form.submit()"
                        >
                            <option value="">Tous les types</option>
                            <option value="quick" {{ request('type') == 'quick' ? 'selected' : '' }}>Services Rapides</option>
                            <option value="long" {{ request('type') == 'long' ? 'selected' : '' }}>Services Longs</option>
                        </select>
                    </form>
                </div>
                
                <!-- Add Service Buttons -->
                <div class="flex gap-3 w-full md:w-auto">
                    <button class="w-full md:w-auto flex items-center justify-center bg-white text-blue-600 px-4 py-2.5 rounded-lg hover:bg-blue-50 font-medium shadow-md transition-all transform hover:scale-105" data-modal-target="quick-service-modal">
                        <i class="fas fa-wrench mr-2"></i>Service Rapide
                    </button>
                    <button class="w-full md:w-auto flex items-center justify-center bg-white text-green-600 px-4 py-2.5 rounded-lg hover:bg-green-50 font-medium shadow-md transition-all transform hover:scale-105" data-modal-target="long-service-modal">
                        <i class="fas fa-tools mr-2"></i>Service Long Terme
                    </button>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md mb-6 animate-fadeIn" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Services Count Summary with Card Effects -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all transform hover:scale-102 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm uppercase tracking-wider">Services Rapides</p>
                        <h3 class="text-3xl font-bold text-blue-600 mt-1">{{ $services->where('type', 'quick')->count() }}</h3>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full shadow-inner">
                        <i class="fas fa-wrench text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all transform hover:scale-102 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm uppercase tracking-wider">Services Longs</p>
                        <h3 class="text-3xl font-bold text-green-600 mt-1">{{ $services->where('type', 'long')->count() }}</h3>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full shadow-inner">
                        <i class="fas fa-tools text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all transform hover:scale-102 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm uppercase tracking-wider">Total Services</p>
                        <h3 class="text-3xl font-bold text-indigo-600 mt-1">{{ $services->count() }}</h3>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-full shadow-inner">
                        <i class="fas fa-concierge-bell text-indigo-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State with Improved Design -->
        @if($services->isEmpty())
            <div class="bg-white rounded-xl shadow-md p-10 text-center border border-gray-100">
                <div class="bg-gray-100 inline-flex p-6 rounded-full mb-4">
                    <i class="fas fa-concierge-bell text-4xl text-gray-400"></i>
                </div>
                <p class="text-gray-600 text-lg mb-3">Aucun service trouvé</p>
                @if(request('search') || request('type'))
                    <a href="{{ route('services.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
                        <i class="fas fa-redo mr-2"></i> Réinitialiser les filtres
                    </a>
                @endif
            </div>
        @else
            <!-- Service Cards with Enhanced Design -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach ($services as $service)
                    <div id="service-{{ $service->id }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all transform hover:scale-102 overflow-hidden border border-gray-100">
                        <!-- Image Container -->
                        <div class="relative h-48 overflow-hidden">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                            
                            <!-- Service Type Badge -->
                            @if($service->type === 'quick')
                                <span class="absolute top-3 right-3 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-md">
                                    <i class="fas fa-bolt mr-1"></i> Rapide
                                </span>
                            @else
                                <span class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-md">
                                    <i class="fas fa-calendar-alt mr-1"></i> Long
                                </span>
                            @endif
                        </div>
                        
                        <!-- Service Content -->
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-3 truncate">{{ $service->name }}</h2>
                            
                            <div class="flex justify-between mb-4">
                                <div class="flex items-center text-gray-600">
                                    <i class="far fa-clock mr-2 text-blue-500"></i>
                                    <span>{{ $service->period ?? 'N/A' }} jours</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-tag mr-2 text-green-500"></i>
                                    <span class="font-semibold">{{ $service->price }} DH</span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-3 pt-3 border-t border-gray-100">
                                <!-- Edit Button -->
                                <a href="{{ route('services.edit', $service->id) }}" 
                                   class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors font-medium text-center">
                                    <i class="fas fa-edit mr-2"></i> Modifier
                                </a>
                                
                                <!-- Delete Form -->
                                <form action="{{ route('services.destroy', $service->id) }}" 
                                      method="POST" 
                                      class="flex-1"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors font-medium">
                                        <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Quick Service Modal -->
    <div id="quick-service-modal" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl transform transition-all animate-fadeIn">
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800">Ajouter un Service Rapide</h2>
                <button type="button" onclick="closeModal('quick-service-modal')" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="type" value="quick">
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nom du Service</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                        placeholder="Nom du Service">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Image du Service</label>
                    <div class="border border-dashed border-gray-300 rounded-lg px-4 py-4 text-center bg-gray-50 @error('image') border-red-500 @enderror">
                        <input type="file" name="image" accept="image/*" class="hidden" id="quick-service-image">
                        <label for="quick-service-image" class="cursor-pointer flex flex-col items-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-blue-500 mb-2"></i>
                            <span class="text-gray-600">Cliquez pour sélectionner une image</span>
                        </label>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Prix (DH)</label>
                        <div class="relative">
                            <input type="number" name="price" value="{{ old('price') }}" 
                                class="w-full border border-gray-300 rounded-lg pl-4 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price') border-red-500 @enderror" 
                                placeholder="Prix">
                            <span class="absolute right-3 top-2.5 text-gray-500">DH</span>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Période (jours)</label>
                        <div class="relative">
                            <input type="number" name="period" value="{{ old('period') }}" 
                                class="w-full border border-gray-300 rounded-lg pl-4 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('period') border-red-500 @enderror" 
                                placeholder="Période">
                            <span class="absolute right-3 top-2.5 text-gray-500">jrs</span>
                        </div>
                        @error('period')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-between pt-4 mt-6 border-t border-gray-200">
                    <button type="button" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium" onclick="closeModal('quick-service-modal')">Annuler</button>
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium flex items-center">
                        <i class="fas fa-plus mr-2"></i> Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Long Service Modal -->
    <div id="long-service-modal" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl transform transition-all animate-fadeIn">
            <div class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800">Ajouter un Service Long Terme</h2>
                <button type="button" onclick="closeModal('long-service-modal')" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="type" value="long">
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nom du Service</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                        placeholder="Nom du Service">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Image du Service</label>
                    <div class="border border-dashed border-gray-300 rounded-lg px-4 py-4 text-center bg-gray-50 @error('image') border-red-500 @enderror">
                        <input type="file" name="image" accept="image/*" class="hidden" id="long-service-image">
                        <label for="long-service-image" class="cursor-pointer flex flex-col items-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-green-500 mb-2"></i>
                            <span class="text-gray-600">Cliquez pour sélectionner une image</span>
                        </label>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Prix (DH)</label>
                        <div class="relative">
                            <input type="number" name="price" value="{{ old('price') }}" 
                                class="w-full border border-gray-300 rounded-lg pl-4 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('price') border-red-500 @enderror" 
                                placeholder="Prix">
                            <span class="absolute right-3 top-2.5 text-gray-500">DH</span>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Période (jours)</label>
                        <div class="relative">
                            <input type="number" name="period" value="{{ old('period') }}" 
                                class="w-full border border-gray-300 rounded-lg pl-4 pr-10 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('period') border-red-500 @enderror" 
                                placeholder="Période">
                            <span class="absolute right-3 top-2.5 text-gray-500">jrs</span>
                        </div>
                        @error('period')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-between pt-4 mt-6 border-t border-gray-200">
                    <button type="button" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium" onclick="closeModal('long-service-modal')">Annuler</button>
                    <button type="submit" class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium flex items-center">
                        <i class="fas fa-plus mr-2"></i> Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom animations -->
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
      document.addEventListener('DOMContentLoaded', function() {
        // Check if there are validation errors and open the appropriate modal
        @if($errors->any())
            @if(old('type') === 'quick')
                document.getElementById('quick-service-modal').classList.remove('hidden');
            @elseif(old('type') === 'long')
                document.getElementById('long-service-modal').classList.remove('hidden');
            @endif
        @endif

        // Modal functionality
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                modal.classList.remove('hidden');
            });
        });

        // Close modal when clicking outside
        document.querySelectorAll('.fixed').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal(modal.id);
                }
            });
        });

        // Close modal function
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
        }

        // File input display
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.files.length > 0) {
                    label.querySelector('span').textContent = this.files[0].name;
                }
            });
        });
    });
    </script>
@endsection