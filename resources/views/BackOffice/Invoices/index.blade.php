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


    <!-- Factors Analysis -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Factors Table -->
        <div class="bg-white rounded-lg shadow-md p-4 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">la liste des Facteurs pour les diagnostics</h3>
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