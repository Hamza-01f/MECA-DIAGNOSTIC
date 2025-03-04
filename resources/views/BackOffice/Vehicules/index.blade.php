@extends('layouts.header')

@section('content')
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800">Gestion des Véhicules</div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Rechercher un véhicule...">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div>
                <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les modèles</option>
                    <option>Dacia</option>
                    <option>Renault</option>
                    <option>Peugeot</option>
                    <option>Ford</option>
                </select>
            </div>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouveau Véhicule
            </button>
        </div>
    </div>

    <!-- Vehicles List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Propriétaire</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matricule</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marque/Modèle</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kilométrage</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernière visite</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">
                                    AB
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Ahmed Benali</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">1234-AB-56</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Renault Clio</div>
                            <div class="text-xs text-gray-500">2020</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">50,000 km</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">10/02/2024</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                À jour
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="#" class="text-blue-500 hover:text-blue-700" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-yellow-500 hover:text-yellow-700" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="text-green-500 hover:text-green-700" title="Nouveau service">
                                    <i class="fas fa-tools"></i>
                                </a>
                                <a href="#" class="text-red-500 hover:text-red-700" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">
                                    MK
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Mohamed Karim</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">5678-CD-78</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Peugeot 208</div>
                            <div class="text-xs text-gray-500">2019</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">75,000 km</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">15/01/2024</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                Maintenance requise
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <a href="#" class="text-blue-500 hover:text-blue-700" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-yellow-500 hover:text-yellow-700" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="text-green-500 hover:text-green-700" title="Nouveau service">
                                    <i class="fas fa-tools"></i>
                                </a>
                                <a href="#" class="text-red-500 hover:text-red-700" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
