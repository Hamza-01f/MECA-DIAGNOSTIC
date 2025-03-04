@extends('layouts.header')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800">Gestion des Clients</div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Rechercher un client...">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouveau Client
            </button>
        </div>
    </div>

    <!-- Client Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        <!-- Client Card 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-500 p-4 text-white flex justify-between items-center">
                <div class="font-semibold">Mohamed Karimi</div>
                <div class="flex space-x-2">
                    <button class="text-white hover:text-blue-200"><i class="fas fa-edit"></i></button>
                    <button class="text-white hover:text-blue-200"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <i class="fas fa-phone text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">+212 661 234 567</span>
                </div>
                <div class="flex items-center mb-3">
                    <i class="fas fa-envelope text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">m.karimi@gmail.com</span>
                </div>
                <div class="flex items-center mb-3">
                    <i class="fas fa-car text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">2 véhicules</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-history text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">5 visites (dernier: 25/02/2025)</span>
                </div>
                <div class="mt-4 flex justify-between">
                    <button class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-eye mr-1"></i> Détails
                    </button>
                    <button class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-car mr-1"></i> Véhicules
                    </button>
                </div>
            </div>
        </div>

        <!-- Client Card 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-500 p-4 text-white flex justify-between items-center">
                <div class="font-semibold">Samir Alami</div>
                <div class="flex space-x-2">
                    <button class="text-white hover:text-blue-200"><i class="fas fa-edit"></i></button>
                    <button class="text-white hover:text-blue-200"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <i class="fas fa-phone text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">+212 678 345 211</span>
                </div>
                <div class="flex items-center mb-3">
                    <i class="fas fa-envelope text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">samir.alami@yahoo.fr</span>
                </div>
                <div class="flex items-center mb-3">
                    <i class="fas fa-car text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">1 véhicule</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-history text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">3 visites (dernier: 24/02/2025)</span>
                </div>
                <div class="mt-4 flex justify-between">
                    <button class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-eye mr-1"></i> Détails
                    </button>
                    <button class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-car mr-1"></i> Véhicules
                    </button>
                </div>
            </div>
        </div>

        <!-- Client Card 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-500 p-4 text-white flex justify-between items-center">
                <div class="font-semibold">Fatima Zahra</div>
                <div class="flex space-x-2">
                    <button class="text-white hover:text-blue-200"><i class="fas fa-edit"></i></button>
                    <button class="text-white hover:text-blue-200"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <i class="fas fa-phone text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">+212 654 987 321</span>
                </div>
                <div class="flex items-center mb-3">
                    <i class="fas fa-envelope text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">f.zahra@gmail.com</span>
                </div>
                <div class="flex items-center mb-3">
                    <i class="fas fa-car text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">1 véhicule</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-history text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">1 visite (dernier: 24/02/2025)</span>
                </div>
                <div class="mt-4 flex justify-between">
                    <button class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-eye mr-1"></i> Détails
                    </button>
                    <button class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-car mr-1"></i> Véhicules
                    </button>
                </div>
            </div>
        </div>

        <!-- Client Card 4 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-500 p-4 text-white flex justify-between items-center">
                <div class="font-semibold">Hassan Amiri</div>
                <div class="flex space-x-2">
                    <button class="text-white hover:text-blue-200"><i class="fas fa-edit"></i></button>
                    <button class="text-white hover:text-blue-200"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <div class="p-4">
                <div class="flex items-center mb-3">
                    <i class="fas fa-phone text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">+212 617 852 963</span>
                </div>
                <div class="flex items-center mb-3">
                    <i class="fas fa-envelope text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">h.amiri@outlook.com</span>
                </div>
                <div class="flex items-center mb-3">
                    <i class="fas fa-car text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">1 véhicule</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-history text-gray-500 w-5"></i>
                    <span class="ml-2 text-gray-700">2 visites (dernier: 23/02/2025)</span>
                </div>
                <div class="mt-4 flex justify-between">
                    <button class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-eye mr-1"></i> Détails
                    </button>
                    <button class="text-blue-500 hover:text-blue-700 flex items-center">
                        <i class="fas fa-car mr-1"></i> Véhicules
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Client Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Ajouter un nouveau client</h3>
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Nom complet*</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Référence</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Automatique" disabled>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Téléphone*</label>
                        <input type="tel" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                        <input type="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Adresse</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Ville</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="border-t pt-4 flex justify-end space-x-4">
                    <button type="button" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection