
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
                <a href="logout" class="flex items-center p-3 space-x-3 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-logout"></i>
                    <span>LogOut</span>
                </a>
                <div class="relative">
                    <i class="fas fa-bell text-xl cursor-pointer"></i>
                    <span class="absolute notification-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">8</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="https://via.placeholder.com/40" alt="Profile" class="h-8 w-8 rounded-full">
                    <span>Hamza Boumanjel</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
            </div>

        </header>

        <!-- Main Layout Wrapper -->
        <div class="flex flex-1 overflow-hidden">
            @include('layouts.sidebar') 
            <main class="main-content flex-1 p-6">
                @yield('content')  
            </main>
        </div>
    </div>
</body>
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
