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

        <!-- Services Overview Section -->
        <div  class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @foreach ($services as $service)
        
                <div id="service-{{ $service->id }}" class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">{{ $service->name }}</h2>
                        <span class="bg-{{ $service->type === 'quick' ? 'blue' : 'green' }}-100 text-{{ $service->type === 'quick' ? 'blue' : 'green' }}-800 px-3 py-1 rounded-full text-sm">{{ ucfirst($service->type) }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-{{ $service->type === 'quick' ? 'blue' : 'green' }}-50 rounded-lg p-3 text-center">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-24 object-cover rounded-lg mb-2">
                            <h3 class="font-medium">{{ $service->name }}</h3>
                            <p class="text-sm text-gray-600">À partir de {{ $service->price }} DH</p>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        {{-- <a href="{{ route('services.edit', $service->id)}}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600" >Edit</button> --}}
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">Delete</button>
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
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Type de Service</label>
                        <select name="type" class="w-full border rounded-lg px-3 py-2">
                            <option value="quick">Service Rapide</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nom du Service</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" placeholder="Nom du Service" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Image du Service</label>
                        <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Prix</label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
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
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Type de Service</label>
                        <select name="type" class="w-full border rounded-lg px-3 py-2">
                            <option value="long">Service Long Terme</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nom du Service</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" placeholder="Nom du Service" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Image du Service</label>
                        <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Prix</label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
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

        <!-- Edit Service Modal -->
        <div id="edit-service-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-8 w-full max-w-md">
                <h2 class="text-2xl font-bold mb-6 text-center">Modifier le Service</h2>
                <form id="edit-service-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Type de Service</label>
                        <select name="type" class="w-full border rounded-lg px-3 py-2">
                            <option value="quick">Service Rapide</option>
                            <option value="long">Service Long Terme</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nom du Service</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" placeholder="Nom du Service" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Image du Service</label>
                        <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Prix</label>
                        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
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
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg" onclick="closeModal('edit-service-modal')">Annuler</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Mettre à jour</button>
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

        // Open Edit Modal
        function openEditModal(serviceId) {
            fetch(`/services/${serviceId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-service-form').action = `/services/${serviceId}`;
                    document.querySelector('select[name="type"]').value = data.type;
                    document.querySelector('input[name="name"]').value = data.name;
                    document.querySelector('input[name="price"]').value = data.price;
                    document.querySelector('input[name="vehicle_model"]').value = data.vehicle_model;
                    document.querySelector('input[name="mileage"]').value = data.mileage;
                    document.getElementById('edit-service-modal').classList.remove('hidden');
                });
        }

       
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        $('#quick-service-modal').submit(function(e) {
        e.preventDefault(); 

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    $('#services-list').append(`
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold text-gray-700">${response.service.name}</h2>
                                <span class="bg-${response.service.type === 'quick' ? 'blue' : 'green'}-100 text-${response.service.type === 'quick' ? 'blue' : 'green'}-800 px-3 py-1 rounded-full text-sm">${response.service.type}</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-${response.service.type === 'quick' ? 'blue' : 'green'}-50 rounded-lg p-3 text-center">
                                    <img src="{{ asset('storage') }}/${response.service.image}" alt="${response.service.name}" class="w-full h-24 object-cover rounded-lg mb-2">
                                    <h3 class="font-medium">${response.service.name}</h3>
                                    <p class="text-sm text-gray-600">À partir de ${response.service.price} DH</p>
                                </div>
                            </div>
                            <div class="mt-4 flex space-x-2">
                                <a href="services/${response.service.id}/edit" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600">Edit</a>
                                <button type="button" onclick="deleteService(${response.service.id})" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">Delete</button>
                            </div>
                        </div>
                    `);
                    closeModal('quick-service-modal'); 
                }
            },
            error: function(response) {
                alert('Error: ' + response.responseJSON.message);
            }
        });
    });

function deleteService(serviceId) {
    if (confirm('Are you sure you want to delete this service?')) {
        $.ajax({
            url: `/services/${serviceId}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                   
                    $(`#service-${serviceId}`).remove();
                }
            },
            error: function(response) {
                alert('Error deleting service');
            }
        });
    }
 }
 </script>

@endsection
