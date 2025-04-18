<aside class="sidebar bg-gradient-to-b from-blue-700 to-purple-800 w-64 shadow-xl p-4 overflow-y-auto rounded-lg border-r border-blue-400">
    <nav>
        <ul class="space-y-3">
            <li class="mb-6">
                <div class="flex items-center justify-center mb-4 animate-pulse">
                    <img src="{{ asset('storage/images/logo.png')  }}" alt="Logo" class="h-16 w-16 rounded-full ring-4 ring-yellow-400 shadow-lg transform hover:scale-110 transition-transform duration-300">
                </div>
                <h2 class="text-white text-center font-bold text-lg">Auto Service Pro</h2>
            </li>
            
            <li class="bg-white bg-opacity-90 rounded-lg text-blue-700 transform hover:scale-105 transition-all duration-300 shadow-md">
                <a href="dashboard" class="flex items-center p-3 space-x-3">
                    <i class="fas fa-tachometer-alt text-blue-600"></i>
                    <span class="font-medium">Tableau de bord</span>
                </a>
            </li>
            
            <li class="transform hover:translate-x-2 transition-transform duration-300">
                <a href="/clients" class="flex items-center p-3 space-x-3 hover:bg-blue-600 rounded-lg text-white group">
                    <i class="fas fa-users text-yellow-300 group-hover:text-white"></i>
                    <span>Clients</span>
                </a>
            </li>
            
            <li class="transform hover:translate-x-2 transition-transform duration-300">
                <a href="vehicules" class="flex items-center p-3 space-x-3 hover:bg-blue-600 rounded-lg text-white group">
                    <i class="fas fa-car text-green-300 group-hover:text-white"></i>
                    <span>Véhicules</span>
                </a>
            </li>
            
            <li class="transform hover:translate-x-2 transition-transform duration-300">
                <a href="/services" class="flex items-center p-3 space-x-3 hover:bg-blue-600 rounded-lg text-white group">
                    <i class="fas fa-tools text-orange-300 group-hover:text-white"></i>
                    <span>Services</span>
                </a>
            </li>
            
            <li class="transform hover:translate-x-2 transition-transform duration-300">
                <a href="Diagnostics" class="flex items-center p-3 space-x-3 hover:bg-blue-600 rounded-lg text-white group">
                    <i class="fas fa-stethoscope text-pink-300 group-hover:text-white"></i>
                    <span>Diagnostics & Facteurs</span>
                </a>
            </li>
            
            <li class="pt-8">
                <a href="logout" class="flex items-center p-3 space-x-3 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </li>
        </ul>
    </nav>
    
</aside>

<style>
    /* Optional custom CSS animations */
    @keyframes gentle-pulse {
        0% { opacity: 0.8; }
        50% { opacity: 1; }
        100% { opacity: 0.8; }
    }
    
    .sidebar {
        animation: gentle-pulse 5s infinite ease-in-out;
    }
    
    .sidebar a:hover i {
        transform: rotate(10deg);
        transition: transform 0.3s ease;
    }
</style>
