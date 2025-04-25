@extends('layouts.header')

@section('content')
    <!-- Filters & Date Range -->
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold text-gray-800">Tableau de bord</div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <form method="GET" action="{{ route('dashboard') }}">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ $search }}"
                        class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Rechercher..."
                    >
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </form>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Total Clients</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $stats['total_clients'] }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-users text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Revenu </p>
                    <h3 class="text-3xl font-bold mt-1">{{ number_format($stats['monthly_revenue'], 0, ',', ' ') }} DH</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fas fa-money-bill-wave text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Diagnostics</p>
                    <h3 class="text-3xl font-bold mt-1">{{ $stats['total_diagnostics'] }}</h3>
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
        <div class="bg-white rounded-lg shadow-md p-4 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Revenus </h3>
            </div>
            <div class="h-80">
                <canvas id="revenueChart" data-revenue="{{ json_encode($revenueData) }}"></canvas>
            </div>
        </div>

        <!-- Service Types Pie Chart -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <h3 class="font-semibold text-lg mb-4">Types de Services</h3>
            <div class="h-80">
                <canvas id="servicesPieChart" data-services="{{ json_encode($serviceTypesData) }}"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Services & Calendar -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Services -->
        <div class="bg-white rounded-lg shadow-md p-4 lg:col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Les premiers 4 Services Récents</h3>
                <a href="{{ route('Diagnostics.index') }}" class="text-blue-500 text-sm">Voir tout</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentDiagnostics as $diagnostic)
                        <tr>
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
                                        'en_attente' => 'bg-blue-100 text-blue-800'
                                    ];
                                    $statusText = [
                                        'complete' => 'Terminé',
                                        'encours' => 'En cours',
                                        'en_attente' => 'En attente'
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
        
        {{-- <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Calendrier</h3>
                <div class="flex items-center space-x-2">
                    <button id="prev-month" class="p-1 rounded-full hover:bg-gray-100">
                        <i class="fas fa-chevron-left text-gray-500"></i>
                    </button>
                    <button id="next-month" class="p-1 rounded-full hover:bg-gray-100">
                        <i class="fas fa-chevron-right text-gray-500"></i>
                    </button>
                </div>
            </div>
            
            <div class="text-center mb-4">
                <h2 id="current-month-year" class="text-xl font-bold text-gray-800"></h2>
            </div>
            
            <div class="grid grid-cols-7 gap-1 mb-2">
                <div class="text-center text-xs font-medium text-gray-500 p-1">Lun</div>
                <div class="text-center text-xs font-medium text-gray-500 p-1">Mar</div>
                <div class="text-center text-xs font-medium text-gray-500 p-1">Mer</div>
                <div class="text-center text-xs font-medium text-gray-500 p-1">Jeu</div>
                <div class="text-center text-xs font-medium text-gray-500 p-1">Ven</div>
                <div class="text-center text-xs font-medium text-gray-500 p-1">Sam</div>
                <div class="text-center text-xs font-medium text-gray-500 p-1">Dim</div>
            </div>
            
            <div id="calendar-days" class="grid grid-cols-7 gap-1"></div>
            
            <div class="mt-4 border-t pt-4">
                <h4 class="font-medium text-gray-700 mb-2">Aujourd'hui</h4>
                <div id="current-date" class="text-2xl font-bold text-blue-600"></div>
                <div id="current-time" class="text-lg text-gray-600"></div>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
<script>
   
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueData = JSON.parse(document.getElementById('revenueChart').dataset.revenue);
    
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: revenueData.labels,
            datasets: [
                {
                    label: 'Revenus',
                    data: revenueData.revenue,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.3,
                    fill: true
                }
                

            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const servicesCtx = document.getElementById('servicesPieChart').getContext('2d');
    const servicesData = JSON.parse(document.getElementById('servicesPieChart').dataset.services);
    
    new Chart(servicesCtx, {
        type: 'pie',
        data: {
            labels: servicesData.labels,
            datasets: [{
                data: servicesData.data,
                backgroundColor: servicesData.colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     let currentDate = new Date();
    //     let currentMonth = currentDate.getMonth();
    //     let currentYear = currentDate.getFullYear();
        
    //     function updateDateTime() {
    //         const now = new Date();
    //         const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    //         document.getElementById('current-date').textContent = now.toLocaleDateString('fr-FR', options);
            
    //         setInterval(() => {
    //             const now = new Date();
    //             document.getElementById('current-time').textContent = now.toLocaleTimeString('fr-FR');
    //         }, 1000);
    //     }
        
    //     function renderCalendar() {
    //         const firstDay = new Date(currentYear, currentMonth, 1);
    //         const lastDay = new Date(currentYear, currentMonth + 1, 0);
    //         const daysInMonth = lastDay.getDate();
    //         const startingDay = firstDay.getDay();
            
            
    //         const adjustedStartingDay = startingDay === 0 ? 6 : startingDay - 1;
            
           
    //         const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", 
    //                             "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
    //         document.getElementById('current-month-year').textContent = 
    //             `${monthNames[currentMonth]} ${currentYear}`;
            
           
    //         const calendarDays = document.getElementById('calendar-days');
    //         calendarDays.innerHTML = '';
            
            
    //         for (let i = 0; i < adjustedStartingDay; i++) {
    //             const emptyDay = document.createElement('div');
    //             emptyDay.className = 'text-center p-1 text-gray-300';
    //             emptyDay.textContent = '';
    //             calendarDays.appendChild(emptyDay);
    //         }
            
           
    //         const today = new Date();
    //         for (let day = 1; day <= daysInMonth; day++) {
    //             const dayElement = document.createElement('div');
    //             dayElement.className = 'text-center p-1 rounded-full cursor-pointer hover:bg-gray-100';
    //             dayElement.textContent = day;
                
                
    //             if (day === currentDate.getDate() && 
    //                 currentMonth === today.getMonth() && 
    //                 currentYear === today.getFullYear()) {
    //                 dayElement.className += ' bg-blue-500 text-white hover:bg-blue-600';
    //             }
                
           
    //             const hasEvent = checkIfDateHasEvent(day, currentMonth + 1, currentYear);
    //             if (hasEvent) {
    //                 dayElement.className += ' font-bold text-blue-600';
    //                 const dot = document.createElement('div');
    //                 dot.className = 'h-1 w-1 mx-auto mt-1 rounded-full bg-blue-500';
    //                 dayElement.appendChild(dot);
    //             }
                
    //             calendarDays.appendChild(dayElement);
    //         }
    //     }
        
    //     function checkIfDateHasEvent(day, month, year) {
    //         return Math.random() > 0.8;
    //     }
        
    //     document.getElementById('prev-month').addEventListener('click', function() {
    //         currentMonth--;
    //         if (currentMonth < 0) {
    //             currentMonth = 11;
    //             currentYear--;
    //         }
    //         renderCalendar();
    //     });
        
    //     document.getElementById('next-month').addEventListener('click', function() {
    //         currentMonth++;
    //         if (currentMonth > 11) {
    //             currentMonth = 0;
    //             currentYear++;
    //         }
    //         renderCalendar();
    //     });
        
    //     updateDateTime();
    //     renderCalendar();
    // });
</script>
@endpush