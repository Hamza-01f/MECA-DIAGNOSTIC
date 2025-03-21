@extends('layouts.header')

@section('content')
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800">Facteurs Influençant les Services</div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Rechercher...">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div>
                <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Février 2025</option>
                    <option>Janvier 2025</option>
                    <option>Décembre 2024</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Factors Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Clients Récurrents</p>
                    <h3 class="text-3xl font-bold mt-1">42</h3>
                    <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up"></i> +8.6%</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Temps Moyen Service</p>
                    <h3 class="text-3xl font-bold mt-1">3.5h</h3>
                    <p class="text-yellow-500 text-sm mt-2"><i class="fas fa-clock"></i> Moyenne</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-stopwatch text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Services Complexes</p>
                    <h3 class="text-3xl font-bold mt-1">18</h3>
                    <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-triangle"></i> Sensibles</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-cogs text-red-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Satisfaction Clients</p>
                    <h3 class="text-3xl font-bold mt-1">4.7/5</h3>
                    <p class="text-green-500 text-sm mt-2"><i class="fas fa-star"></i> Excellent</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-smile text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Factors Analysis -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Factors Table -->
        <div class="bg-white rounded-lg shadow-md p-4 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Analyse des Facteurs de Service</h3>
                <button class="text-blue-500 text-sm">Exporter</button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Facteur</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Impact</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tendance</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">Temps de Réponse</td>
                            <td class="px-4 py-3 text-sm text-gray-500">Modéré</td>
                            <td class="px-4 py-3 text-sm text-yellow-500">Stable</td>
                            <td class="px-4 py-3 text-sm text-green-500">Bon</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">Satisfaction Client</td>
                            <td class="px-4 py-3 text-sm text-gray-500">Elevée</td>
                            <td class="px-4 py-3 text-sm text-green-500">En Amélioration</td>
                            <td class="px-4 py-3 text-sm text-green-500">Excellente</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">Disponibilité du Service</td>
                            <td class="px-4 py-3 text-sm text-gray-500">Très Bonne</td>
                            <td class="px-4 py-3 text-sm text-green-500">Croissante</td>
                            <td class="px-4 py-3 text-sm text-green-500">Optimale</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">Compétence des Agents</td>
                            <td class="px-4 py-3 text-sm text-gray-500">Excellente</td>
                            <td class="px-4 py-3 text-sm text-green-500">Stable</td>
                            <td class="px-4 py-3 text-sm text-green-500">Excellente</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-500">Coût des Services</td>
                            <td class="px-4 py-3 text-sm text-gray-500">Moyenne</td>
                            <td class="px-4 py-3 text-sm text-yellow-500">Stable</td>
                            <td class="px-4 py-3 text-sm text-orange-500">Modéré</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection