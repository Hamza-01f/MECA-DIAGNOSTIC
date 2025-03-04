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
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-oil-can text-blue-500 mr-3"></i>
                        <span>Vidange</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-car-side text-blue-500 mr-3"></i>
                        <span>Changement de Pneus</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-brake text-blue-500 mr-3"></i>
                        <span>Changement Plaquettes</span>
                    </li>
                </ul>
            </div>

            <!-- Long-Term Services Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Services Long Terme</h2>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">4 Types</span>
                </div>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-cogs text-green-500 mr-3"></i>
                        <span>Kit d'Embrayage</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-bezier-curve text-green-500 mr-3"></i>
                        <span>Changement Turbo</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-tools text-green-500 mr-3"></i>
                        <span>Changement Culasse</span>
                    </li>
                </ul>
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
                            <i class="fas fa-car text-gray-500 mr-3"></i>
                            <span class="font-medium">Renault Clio</span>
                        </div>
                        <span class="text-sm text-gray-500">Vidange</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-car text-gray-500 mr-3"></i>
                            <span class="font-medium">Dacia Duster</span>
                        </div>
                        <span class="text-sm text-gray-500">Changement Pneus</span>
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