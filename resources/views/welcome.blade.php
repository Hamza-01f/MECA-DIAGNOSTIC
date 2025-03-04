<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MECA DIAGNOSTIC - Dashboard Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        .sidebar {
            height: calc(100vh - 4rem);
        }
        .main-content {
            height: calc(100vh - 4rem);
            overflow-y: auto;
        }
        .service-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        .notification-badge {
            top: -5px;
            right: -5px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex flex-col h-screen">
        <!-- Header -->
        <header class="bg-blue-700 text-white h-16 flex items-center justify-between px-6 shadow-md">
            <div class="flex items-center space-x-4">
                <span class="text-2xl font-bold">MECA DIAGNOSTIC</span>
                <span class="bg-blue-600 px-3 py-1 rounded-full text-xs">Admin</span>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i class="fas fa-bell text-xl cursor-pointer"></i>
                    <span class="absolute notification-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">8</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="https://via.placeholder.com/40" alt="Profile" class="h-8 w-8 rounded-full">
                    <span>Aymane Benhima</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar -->
            <aside class="sidebar bg-white w-64 shadow-lg p-4 overflow-y-auto">
                <nav>
                    <ul class="space-y-2">
                        <li class="mb-6">
                            <div class="flex items-center justify-center mb-4">
                                <img src="https://via.placeholder.com/80" alt="Logo" class="h-16 w-16 rounded-full">
                            </div>
                            <h3 class="text-center text-gray-500">Youcode Youssoufia</h3>
                        </li>
                        <li class="bg-blue-100 rounded-lg text-blue-700">
                            <a href="#" class="flex items-center p-3 space-x-3">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Tableau de bord</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 space-x-3 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-users"></i>
                                <span>Clients</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 space-x-3 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-car"></i>
                                <span>Véhicules</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 space-x-3 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-tools"></i>
                                <span>Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 space-x-3 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-stethoscope"></i>
                                <span>Diagnostics</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 space-x-3 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-file-invoice"></i>
                                <span>Factures</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 space-x-3 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-chart-line"></i>
                                <span>Rapports & Statistiques</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-3 space-x-3 hover:bg-gray-100 rounded-lg">
                                <i class="fas fa-cog"></i>
                                <span>Paramètres</span>
                            </a>
                        </li>
                        <li class="pt-8">
                            <a href="#" class="flex items-center p-3 space-x-3 text-red-600 hover:bg-red-50 rounded-lg">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="main-content flex-1 p-6">
                <!-- Filters & Date Range -->
                <div class="flex justify-between items-center mb-6">
                    <div class="text-2xl font-bold text-gray-800">Tableau de bord</div>
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

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500">Total Clients</p>
                                <h3 class="text-3xl font-bold mt-1">128</h3>
                                <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up"></i> +12.5%</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500">Services en cours</p>
                                <h3 class="text-3xl font-bold mt-1">24</h3>
                                <p class="text-red-500 text-sm mt-2"><i class="fas fa-arrow-down"></i> -3.8%</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-tools text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500">Revenu mensuel</p>
                                <h3 class="text-3xl font-bold mt-1">48 560 DH</h3>
                                <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up"></i> +18.2%</p>
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
                                <h3 class="text-3xl font-bold mt-1">86</h3>
                                <p class="text-green-500 text-sm mt-2"><i class="fas fa-arrow-up"></i> +5.3%</p>
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
                            <h3 class="font-semibold text-lg">Revenus et Dépenses</h3>
                            <div>
                                <select class="border rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Derniers 30 jours</option>
                                    <option>Ce mois</option>
                                    <option>Cette année</option>
                                </select>
                            </div>
                        </div>
                        <div class="h-80">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Service Types Pie Chart -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="font-semibold text-lg mb-4">Types de Services</h3>
                        <div class="h-80">
                            <canvas id="servicesPieChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Services & Notifications -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Services -->
                    <div class="bg-white rounded-lg shadow-md p-4 lg:col-span-2">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-lg">Services Récents</h3>
                            <a href="#" class="text-blue-500 text-sm">Voir tout</a>
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
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">MK</div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Mohamed Karimi</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <p class="text-sm text-gray-700">Dacia Duster</p>
                                            <p class="text-xs text-gray-500">123456-A-5</p>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <p class="text-sm text-gray-700">Vidange</p>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Terminé</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">25/02/2025</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">SA</div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Samir Alami</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <p class="text-sm text-gray-700">Renault Clio</p>
                                            <p class="text-xs text-gray-500">78542-B-20</p>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <p class="text-sm text-gray-700">Changement d'embrayage</p>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">En cours</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">24/02/2025</td>
                                    </tr>
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
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700">HA</div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Hassan Amiri</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <p class="text-sm text-gray-700">Ford Fiesta</p>
                                            <p class="text-xs text-gray-500">45678-D-8</p>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <p class="text-sm text-gray-700">Changement pneus</p>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Terminé</span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">23/02/2025</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Notifications & Reminders -->
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-lg">Notifications</h3>
                            <a href="#" class="text-blue-500 text-sm">Tout marquer comme lu</a>
                        </div>
                        <div class="space-y-4 h-80 overflow-y-auto">
                            <div class="p-3 bg-red-50 border-l-4 border-red-500 rounded">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-red-800">Rappel urgent</p>
                                    <span class="text-red-500 text-xs">Il y a 2h</span>
                                </div>
                                <p class="text-sm text-red-700 mt-1">La Mercedes de M. Tazi a besoin d'une vérification immédiate du système de freinage</p>
                            </div>
                            <div class="p-3 bg-yellow-50 border-l-4 border-yellow-500 rounded">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-yellow-800">Pièces en attente</p>
                                    <span class="text-yellow-500 text-xs">Il y a 5h</span>
                                </div>
                                <p class="text-sm text-yellow-700 mt-1">Les plaquettes de frein pour la Golf sont en attente de livraison</p>
                            </div>
                            <div class="p-3 bg-green-50 border-l-4 border-green-500 rounded">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-green-800">Service terminé</p>
                                    <span class="text-green-500 text-xs">Il y a 8h</span>
                                </div>
                                <p class="text-sm text-green-700 mt-1">Vidange terminée pour la Fiat de Mme Benani. Prêt pour livraison.</p>
                            </div>
                            <div class="p-3 bg-blue-50 border-l-4 border-blue-500 rounded">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-blue-800">Nouveau rendez-vous</p>
                                    <span class="text-blue-500 text-xs">Il y a 1j</span>
                                </div>
                                <p class="text-sm text-blue-700 mt-1">M. Rachid a pris RDV pour le 28/02 à 14h pour un diagnostic complet</p>
                            </div>
                            <div class="p-3 bg-purple-50 border-l-4 border-purple-500 rounded">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-purple-800">Rappel de maintenance</p>
                                    <span class="text-purple-500 text-xs">Il y a 1j</span>
                                </div>
                                <p class="text-sm text-purple-700 mt-1">Rappeler les clients ayant atteint les 10 000 km depuis leur dernier service</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['1 Fev', '5 Fev', '10 Fev', '15 Fev', '20 Fev', '25 Fev'],
                datasets: [
                    {
                        label: 'Revenus',
                        data: [12000, 19000, 16500, 25000, 23400, 28500],
                        borderColor: 'rgba(59, 130, 246, 1)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Dépenses',
                        data: [8000, 12000, 11500, 14000, 13200, 15000],
                        borderColor: 'rgba(239, 68, 68, 1)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + ' DH';
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });

        // Services Pie Chart
        const servicesCtx = document.getElementById('servicesPieChart').getContext('2d');
        const servicesPieChart = new Chart(servicesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Vidange', 'Diagnostic', 'Pneus', 'Freins', 'Embrayage', 'Autres'],
                datasets: [{
                    data: [35, 20, 15, 10, 8, 12],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(107, 114, 128, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                cutout: '65%'
            }
        });
    </script>
</body>
</html>
