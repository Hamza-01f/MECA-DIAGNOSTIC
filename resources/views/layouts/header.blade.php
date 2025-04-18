
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MECA DIAGNOSTIC - Dashboard Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans">
    <div class="flex flex-col h-screen">
        <!-- Enhanced Header -->
        <header class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 text-white h-20 flex items-center justify-between px-6 shadow-lg relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-20 h-20 rounded-full bg-yellow-300 -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-32 h-32 rounded-full bg-blue-300 translate-x-1/2 translate-y-1/2"></div>
            </div>
            
            <div class="flex items-center space-x-4 z-10">
                <div class="bg-white text-blue-700 p-2 rounded-lg shadow-md transform rotate-3 hover:rotate-0 transition-transform duration-300">
                    <span class="text-2xl font-extrabold tracking-wider">MECA DIAGNOSTIC</span>
                </div>
            </div>
            
            <div class="flex items-center space-x-6 z-10">
                <a href="logout" class="flex items-center p-3 space-x-2 bg-white/10 hover:bg-white/20 rounded-lg transition-all duration-300 border border-white/30 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>
                    <span>Logout</span>
                </a>
                
                <div class="flex items-center space-x-3 bg-blue-800/40 py-2 px-4 rounded-full border-2 border-blue-300/30">
                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-yellow-300 to-orange-500 flex items-center justify-center text-blue-900 font-bold">
                        HB
                    </div>
                    <span class="font-medium">Hamza Boumanjel</span>
                </div>
            </div>
        </header>
        
        <!-- Main Layout Wrapper -->
        <div class="flex flex-1 overflow-hidden">
            @include('layouts.sidebar')
            
            <main class="main-content flex-1 p-6 bg-white rounded-tl-3xl mt-2 ml-2 shadow-md">
                @yield('content')
            </main>
        </div>
    </div>
</body>
@stack('scripts')
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
</html>
