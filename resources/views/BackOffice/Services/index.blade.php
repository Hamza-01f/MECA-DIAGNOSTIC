@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Gestion des Services</h1>
            <div class="flex space-x-4">
                <!-- Search Form -->
                <form method="GET" action="{{ route('services.index') }}" class="relative">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Rechercher un service..."
                    >
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    @if(request('search'))
                        <a href="{{ route('services.index', ['type' => request('type')]) }}" 
                           class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
                
                <!-- Type Filter -->
                <form method="GET" action="{{ route('services.index') }}">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <select 
                        name="type" 
                        class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()"
                    >
                        <option value="">Tous les types</option>
                        <option value="quick" {{ request('type') == 'quick' ? 'selected' : '' }}>Services Rapides</option>
                        <option value="long" {{ request('type') == 'long' ? 'selected' : '' }}>Services Longs</option>
                    </select>
                </form>
                
                <!-- Add Service Buttons -->
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors" data-modal-target="quick-service-modal">
                    <i class="fas fa-wrench mr-2"></i>Service Rapide
                </button>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors" data-modal-target="long-service-modal">
                    <i class="fas fa-tools mr-2"></i>Service Long Terme
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Services Count Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Services Rapides</p>
                        <h3 class="text-2xl font-bold">{{ $services->where('type', 'quick')->count() }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-wrench text-blue-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Services Longs</p>
                        <h3 class="text-2xl font-bold">{{ $services->where('type', 'long')->count() }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-tools text-green-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Services</p>
                        <h3 class="text-2xl font-bold">{{ $services->count() }}</h3>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-concierge-bell text-purple-500"></i>
                    </div>
                </div>
            </div>
        </div>

        @if($services->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <i class="fas fa-concierge-bell text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">Aucun service trouvé</p>
                @if(request('search') || request('type'))
                    <a href="{{ route('services.index') }}" class="text-blue-500 hover:text-blue-700 mt-2 inline-block">
                        Réinitialiser les filtres
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @foreach ($services as $service)
                    <div id="service-{{ $service->id }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-gray-700">{{ $service->name }}</h2>
                            @if($service->type === 'quick')
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Rapide</span>
                            @else
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Long</span>
                            @endif
                        </div>
                        <div class="mb-4">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-40 object-cover rounded-lg mb-2">
                            @else
                                <div class="w-full h-40 bg-gray-200 rounded-lg mb-2 flex items-center justify-center">
                                    <span class="text-gray-500">Pas d'image</span>
                                </div>
                            @endif
                        </div>
                        <div class="mb-2">
                            <p class="text-gray-600"><span class="font-medium">Période:</span> {{ $service->period ?? 'N/A' }} jours</p>
                            <p class="text-gray-600"><span class="font-medium">Prix:</span> {{ $service->price }} DH</p>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('services.edit', $service->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 transition-colors">Modifier</a>
                            
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition-colors">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
    <!-- quick service model -->
    <div id="quick-service-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Ajouter un Service Rapide</h2>
            <form id="quickServiceForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="quick">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nom du Service</label>
                    <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" placeholder="Nom du Service" required>
                    <span class="text-red-500 text-sm error-name"></span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Image du Service</label>
                    <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                    <span class="text-red-500 text-sm error-image"></span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Prix (DH)</label>
                    <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH" required>
                    <span class="text-red-500 text-sm error-price"></span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Période (jours)</label>
                    <input type="number" name="period" class="w-full border rounded-lg px-3 py-2" placeholder="Période en jours" required>
                    <span class="text-red-500 text-sm error-period"></span>
                </div>
                <div class="mt-6 flex justify-between">
                    <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg" onclick="closeModal('quick-service-modal')">Annuler</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Long Service Modal -->
    <div id="long-service-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Ajouter un Service Long Terme</h2>
            <form id="longServiceForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="long">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nom du Service</label>
                    <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" placeholder="Nom du Service" required>
                    <span class="text-red-500 text-sm error-name"></span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Image du Service</label>
                    <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                    <span class="text-red-500 text-sm error-image"></span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Prix (DH)</label>
                    <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH" required>
                    <span class="text-red-500 text-sm error-price"></span>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Période (jours)</label>
                    <input type="number" name="period" class="w-full border rounded-lg px-3 py-2" placeholder="Période en jours" required>
                    <span class="text-red-500 text-sm error-period"></span>
                </div>
                <div class="mt-6 flex justify-between">
                    <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg" onclick="closeModal('long-service-modal')">Annuler</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
                </div>
            </form>
        </div>
    </div>


    <script>
       
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                modal.classList.toggle('hidden');
            });
        });

        document.querySelectorAll('.fixed').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const modal = this.closest('.fixed');
                if (modal) {
                    modal.classList.add('hidden');
                }
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