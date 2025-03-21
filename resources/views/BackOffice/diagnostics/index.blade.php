@extends('layouts.header')

@section('content')
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800">Diagnostics</div>
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

    <!-- Diagnostics Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Total Diagnostics</p>
                    <h3 class="text-3xl font-bold mt-1">86</h3>
                    <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up"></i> +5.3%</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-stethoscope text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Diagnostics Urgents</p>
                    <h3 class="text-3xl font-bold mt-1">12</h3>
                    <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-triangle"></i> Attention</p>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <i class="fas fa-clock text-red-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">En Cours</p>
                    <h3 class="text-3xl font-bold mt-1">24</h3>
                    <p class="text-yellow-500 text-sm mt-2"><i class="fas fa-spinner"></i> En Traitement</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-tools text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Terminés</p>
                    <h3 class="text-3xl font-bold mt-1">50</h3>
                    <p class="text-green-500 text-sm mt-2"><i class="fas fa-check"></i> Complétés</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Diagnostics List & Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Diagnostics Table -->
        <div class="bg-white rounded-lg shadow-md p-4 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Liste des Diagnostics</h3>
                <a href="#" class="text-blue-500 text-sm">Nouveau Diagnostic</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">FZ</div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Fatima Zahra</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-gray-700">Peugeot 208</p>
                                <p class="text-xs text-gray-500">96325-C-15</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-gray-700">Diagnostic complet</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">En attente</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">24/02/2025</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-blue-500 hover:text-blue-700"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="text-green-500 hover:text-green-700"><i class="fas fa-edit"></i></a>
                                </div>
                            </td>
                        </tr>
                        <!-- Add more diagnostic rows here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Diagnostic Types Pie Chart -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <h3 class="font-semibold text-lg mb-4">Types de Diagnostics</h3>
            <div class="h-80">
                <canvas id="diagnosticTypesChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Pie Chart for Diagnostic Types
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('diagnosticTypesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Diagnostic Complet', 'Freins', 'Suspension', 'Moteur', 'Électrique'],
                datasets: [{
                    data: [40, 20, 15, 15, 10],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
@endsection