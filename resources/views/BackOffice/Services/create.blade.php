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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Quick Services Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Services Rapides</h2>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">5 Types</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 rounded-lg p-3 text-center">
                        <img src="https://www.pexels.com/photo/person-changing-car-oil-4489731/" alt="Vidange" class="w-full h-24 object-cover rounded-lg mb-2">
                        <h3 class="font-medium">Vidange</h3>
                        <p class="text-sm text-gray-600">À partir de 300 DH</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-3 text-center">
                        <img src="https://www.pexels.com/photo/black-car-on-lift-3806240/" alt="Changement Pneus" class="w-full h-24 object-cover rounded-lg mb-2">
                        <h3 class="font-medium">Changement Pneus</h3>
                        <p class="text-sm text-gray-600">À partir de 500 DH</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-3 text-center">
                        <img src="/api/placeholder/100/100" alt="Plaquettes" class="w-full h-24 object-cover rounded-lg mb-2">
                        <h3 class="font-medium">Changement Plaquettes</h3>
                        <p class="text-sm text-gray-600">À partir de 400 DH</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-3 text-center">
                        <img src="/api/placeholder/100/100" alt="Amortisseurs" class="w-full h-24 object-cover rounded-lg mb-2">
                        <h3 class="font-medium">Changement Amortisseurs</h3>
                        <p class="text-sm text-gray-600">À partir de 800 DH</p>
                    </div>
                </div>
            </div>

            <!-- Long-Term Services Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Services Long Terme</h2>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">4 Types</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-green-50 rounded-lg p-3 text-center">
                        <img src="/api/placeholder/100/100" alt="Kit Embrayage" class="w-full h-24 object-cover rounded-lg mb-2">
                        <h3 class="font-medium">Kit Embrayage</h3>
                        <p class="text-sm text-gray-600">À partir de 2 500 DH</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-3 text-center">
                        <img src="/api/placeholder/100/100" alt="Turbo" class="w-full h-24 object-cover rounded-lg mb-2">
                        <h3 class="font-medium">Changement Turbo</h3>
                        <p class="text-sm text-gray-600">À partir de 4 000 DH</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-3 text-center">
                        <img src="/api/placeholder/100/100" alt="Culasse" class="w-full h-24 object-cover rounded-lg mb-2">
                        <h3 class="font-medium">Changement Culasse</h3>
                        <p class="text-sm text-gray-600">À partir de 3 500 DH</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-3 text-center">
                        <img src="/api/placeholder/100/100" alt="Chaîne Distribution" class="w-full h-24 object-cover rounded-lg mb-2">
                        <h3 class="font-medium">Chaîne Distribution</h3>
                        <p class="text-sm text-gray-600">À partir de 2 800 DH</p>
                    </div>
                </div>
            </div>

            <!-- Recent Services Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Services Récents</h2>
                    <a href="#" class="text-blue-500 text-sm">Voir tout</a>
                </div>
                <ul class="space-y-3">
                    <li class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" alt="Service" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <span class="font-medium">Renault Clio</span>
                                <p class="text-xs text-gray-500">Vidange - 350 DH</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">25/02/2025</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" alt="Service" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <span class="font-medium">Dacia Duster</span>
                                <p class="text-xs text-gray-500">Changement Pneus - 600 DH</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">24/02/2025</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Modals for Adding Services -->
        <!-- Quick Service Modal -->
        <div id="quick-service-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-8 w-full max-w-md">
                <h2 class="text-2xl font-bold mb-6 text-center">Ajouter un Service Rapide</h2>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Type de Service</label>
                        <select class="w-full border rounded-lg px-3 py-2">
                            <option>Vidange</option>
                            <option>Changement de Pneus</option>
                            <option>Changement Plaquettes de Frein</option>
                            <option>Changement d'Amortisseurs</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Image du Service</label>
                        <input type="file" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Prix</label>
                        <input type="number" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Véhicule</label>
                            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Modèle">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Kilométrage</label>
                            <input type="number" class="w-full border rounded-lg px-3 py-2" placeholder="KM">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between">
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Annuler</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Long Service Modal -->
        <div id="long-service-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-8 w-full max-w-md">
                <h2 class="text-2xl font-bold mb-6 text-center">Ajouter un Service Long Terme</h2>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Type de Service</label>
                        <select class="w-full border rounded-lg px-3 py-2">
                            <option>Changement Kit d'Embrayage</option>
                            <option>Changement Turbo</option>
                            <option>Changement Culasse</option>
                            <option>Changement Chaîne Distribution</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Image du Service</label>
                        <input type="file" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Prix</label>
                        <input type="number" class="w-full border rounded-lg px-3 py-2" placeholder="Prix en DH">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Véhicule</label>
                            <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Modèle">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Kilométrage</label>
                            <input type="number" class="w-full border rounded-lg px-3 py-2" placeholder="KM">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-between">
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Annuler</button>
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
    </script>
@endsection