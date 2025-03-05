<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MécaniGest - Atelier Mécanique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .bg-pattern {
            background-image: 
                linear-gradient(rgba(31, 41, 55, 0.9), rgba(17, 24, 39, 0.95)),
                repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(255,255,255,0.05) 20px, rgba(255,255,255,0.05) 40px);
        }
    </style>
</head>
<body class="bg-pattern min-h-screen flex flex-col bg-gray-900 text-white">
    <!-- Navbar -->
    <nav class="w-full py-5 px-8 flex justify-between items-center border-b border-gray-800">
        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 3v5l4 3l4 3l3 3l-2 1l-4 -4l-6 -5h-5l4 -3z" />
                <path d="M3 3l18 18" />
                <path d="M9 15l3 3l4 -3l3 -2" />
            </svg>
            <span class="text-2xl font-bold text-white">MécaniGest</span>
        </div>
        <div class="flex items-center space-x-6">
            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors duration-300 hover:underline">
                Connexion
            </a>
            <a href="{{ route('register') }}" class="text-gray-300 hover:text-white transition-colors duration-300 hover:underline">
                Inscription
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-8 py-16 grid md:grid-cols-2 gap-12 items-center">
        <!-- Left Side - Features -->
        <div class="space-y-8">
            <h1 class="text-5xl font-extrabold leading-tight">
                Gérez Votre Atelier 
                <span class="block text-blue-500">Avec Intelligence</span>
            </h1>
            <div class="space-y-4">
                <div class="flex items-center space-x-4 bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                    </svg>
                    <span>Gestion Complète des Services Mécaniques</span>
                </div>
                <div class="flex items-center space-x-4 bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Suivi Financier et Facturation Précis</span>
                </div>
                <div class="flex items-center space-x-4 bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Notifications et Alertes Personnalisées</span>
                </div>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('register')}}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-transform transform hover:scale-105">
                    Démarrer Maintenant
                </a>
            </div>
        </div>

        <!-- Right Side - Illustration -->
        <div class="flex justify-center items-center">
            <div class="relative w-full max-w-md">
                <div class="absolute -inset-2 bg-blue-500 rounded-full opacity-50 blur-2xl"></div>
                <svg class="relative z-10" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#2563EB" d="M250,50 Q400,200 350,250 Q300,300 250,450 Q200,300 150,250 Q100,200 250,50Z" />
                    <circle cx="250" cy="250" r="120" fill="white" />
                    <path fill="#1E40AF" d="M250,200 L280,240 L320,245 L290,275 L300,315 L250,290 L200,315 L210,275 L180,245 L220,240 Z" />
                </svg>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full py-6 border-t border-gray-800 text-center">
        <p class="text-gray-400">© 2024 MécaniGest - Tous droits réservés</p>
    </footer>
</body>
</html>