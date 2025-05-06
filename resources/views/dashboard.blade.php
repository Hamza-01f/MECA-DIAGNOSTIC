@extends('layouts.header')

@section('content')
    <!-- Filters & Date Range -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="text-2xl font-bold text-gray-800">Tableau de bord</div>
        
        <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-4 w-full md:w-auto">
            <div class="relative w-full md:w-64">
                <form method="GET" action="{{ route('dashboard') }}" class="flex items-center">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ $search }}"
                        class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full" 
                        placeholder="Rechercher..."
                    >
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </form>
            </div>
            
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Total Clients Card -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Total Clients</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $stats['total_clients'] }}</h3>
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Revenue Card -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">les Revenus</p>
                    <h3 class="text-3xl font-bold mt-1">{{ number_format($stats['monthly_revenue'], 0, ',', ' ') }} DH</h3>
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-money-bill-wave text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Diagnostics Card -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Diagnostics</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $stats['total_diagnostics'] }}</h3>
                    
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <i class="fas fa-stethoscope text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Tables Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-lg shadow-md p-4 lg:col-span-2 hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Revenus mensuels</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-full" id="revenueMonthBtn">Ce mois</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full" id="revenueYearBtn">Cette année</button>
                </div>
            </div>
            <!-- this will hold monthly and yearly data -->
            <div class="h-80">
                <!-- data-monethly is a custom data attribute -->
                <canvas id="revenueChart" data-monthly="{{ json_encode($revenueData) }}" data-yearly="{{ json_encode($yearlyRevenueData) }}"></canvas>
            </div>
        </div>

        <!-- Service Types Pie Chart -->
        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Répartition des services</h3>
                <div class="text-sm text-gray-500">{{ number_format($stats['monthly_revenue'], 0, ',', ' ') }} DH total</div>
            </div>
            <div class="h-80">
                <canvas id="servicesPieChart" data-services="{{ json_encode($serviceTypesData) }}"></canvas>
            </div>
        </div>
    </div>
    

    <!-- Recent Services & Calendar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Services -->
        <div class="bg-white rounded-lg shadow-md p-4 lg:col-span-2 hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">les 4 Diagnostics Récents</h3>
                <a href="{{ route('Diagnostics.index') }}" class="text-blue-500 text-sm hover:text-blue-700">Voir tout</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentDiagnostics as $diagnostic)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">
                                        {{ substr($diagnostic->client->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $diagnostic->client->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $diagnostic->client->phone }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-gray-700">{{ $diagnostic->vehicule->marque }} {{ $diagnostic->vehicule->model }}</p>
                                <p class="text-xs text-gray-500">{{ $diagnostic->vehicule->matricule }}</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-gray-700">{{ $diagnostic->service->name }}</p>
                                <p class="text-xs text-gray-500">{{ number_format($diagnostic->service->price, 2, ',', ' ') }} DH</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @php
                                    $statusClasses = [
                                        'complete' => 'bg-green-100 text-green-800',
                                        'encours' => 'bg-yellow-100 text-yellow-800',
                                      
                                    ];
                                    $statusText = [
                                        'complete' => 'Terminé',
                                        'encours' => 'En cours',
                                       
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs rounded-full {{ $statusClasses[$diagnostic->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusText[$diagnostic->status] ?? $diagnostic->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                {{ $diagnostic->date->format('d/m/Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                Aucun diagnostic trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
@endsection

@push('scripts')
<script>
    // Revenue Chart 
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueData = {
        monthly: JSON.parse(document.getElementById('revenueChart').dataset.monthly),
        yearly: JSON.parse(document.getElementById('revenueChart').dataset.yearly)
    };
    
    let revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: revenueData.monthly.labels,
            datasets: [{
                label: 'Revenus (DH)',
                data: revenueData.monthly.revenue,
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y.toLocaleString() + ' DH';
                        }
                    }
                }
            }
        }
    });
    
    // Toggle buttons
    document.getElementById('revenueMonthBtn').addEventListener('click', function() {
        updateRevenueChart('monthly');
        this.classList.add('bg-blue-100', 'text-blue-600');
        this.classList.remove('bg-gray-100', 'text-gray-600');
        document.getElementById('revenueYearBtn').classList.add('bg-gray-100', 'text-gray-600');
        document.getElementById('revenueYearBtn').classList.remove('bg-blue-100', 'text-blue-600');
    });
    
    document.getElementById('revenueYearBtn').addEventListener('click', function() {
        updateRevenueChart('yearly');
        this.classList.add('bg-blue-100', 'text-blue-600');
        this.classList.remove('bg-gray-100', 'text-gray-600');
        document.getElementById('revenueMonthBtn').classList.add('bg-gray-100', 'text-gray-600');
        document.getElementById('revenueMonthBtn').classList.remove('bg-blue-100', 'text-blue-600');
    });
    
    function updateRevenueChart(type) {
        revenueChart.data.labels = revenueData[type].labels;
        revenueChart.data.datasets[0].data = revenueData[type].revenue;
        revenueChart.update();
    }
    
    // Services Pie Chart
    const servicesCtx = document.getElementById('servicesPieChart').getContext('2d');
    const servicesData = JSON.parse(document.getElementById('servicesPieChart').dataset.services);
    
    new Chart(servicesCtx, {
        type: 'doughnut',
        data: {
            labels: servicesData.labels,
            datasets: [{
                data: servicesData.data,
                backgroundColor: servicesData.colors,
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 12,
                        padding: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush