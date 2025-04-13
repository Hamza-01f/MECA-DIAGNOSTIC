@extends('layouts.header')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Gestion des Services</h1>
            <div class="flex space-x-4">
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

        <!-- Services Overview Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @foreach ($services as $service)
                <div id="service-{{ $service->id }}" class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">{{ $service->name }}</h2>
                        <span class="bg-{{ $service->type === 'quick' ? 'blue' : 'green' }}-100 text-{{ $service->type === 'quick' ? 'blue' : 'green' }}-800 px-3 py-1 rounded-full text-sm">{{ ucfirst($service->type) }}</span>
                    </div>
                    <div class="mb-4">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-40 object-cover rounded-lg mb-2">
                        @else
                            <div class="w-full h-40 bg-gray-200 rounded-lg mb-2 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="mb-2">
                        <p class="text-gray-600"><span class="font-medium">Period:</span> {{ $service->period ?? 'N/A' }} jeur</p>
                        <p class="text-gray-600"><span class="font-medium">Prix:</span> {{ $service->price }} DH</p>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('services.edit', $service->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">Modifier</a>
                        
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modals for Adding Services -->
        <!-- Quick Service Modal -->
        <div id="quick-service-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-8 w-full max-w-md">
                <h2 class="text-2xl font-bold mb-6 text-center">Ajouter un Service Rapide</h2>
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" id="quick-service-form">
                    @csrf
                    <input type="hidden" name="type" value="quick">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nom du Service</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" placeholder="Nom du Service" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Image du Service</label>
                        <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Prix (DH)</label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH" required>
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">period du service</label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="Period en jeurs" required>
                        @error('period')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
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
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" id="long-service-form">
                    @csrf
                    <input type="hidden" name="type" value="long">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nom du Service</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" placeholder="Nom du Service" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Image du Service</label>
                        <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Prix (DH)</label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH" required>
                        @error('price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Véhicule</label>
                            <input type="text" name="vehicle_model" class="w-full border rounded-lg px-3 py-2" placeholder="Modèle">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Kilométrage</label>
                            <input type="number" name="mileage" class="w-full border rounded-lg px-3 py-2" placeholder="KM">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between">
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg" onclick="closeModal('long-service-modal')">Annuler</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal Toggle Function
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                modal.classList.toggle('hidden');
            });
        });

        // Close Modal when clicking outside
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

        // Close modal after form submission
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const modal = this.closest('.fixed');
                if (modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection