<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Atelier Mécanique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .bg-pattern {
            background-color: #f4f4f4;
            background-image: 
                linear-gradient(45deg, rgba(0,0,0,0.05) 25%, transparent 25%), 
                linear-gradient(-45deg, rgba(0,0,0,0.05) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(0,0,0,0.05) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(0,0,0,0.05) 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center bg-pattern">
        <div class="w-full max-w-md bg-white shadow-2xl rounded-xl overflow-hidden">
            <div class="bg-blue-600 py-6 px-8 text-center">
                <h1 class="text-3xl font-bold text-white flex items-center justify-center">
                    <i class="fas fa-car-alt mr-3"></i>
                    Atelier Mécanique
                </h1>
            </div>
            <form class="p-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label class="block text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="email" 
                            name="email"
                            required
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Votre email"
                        >
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="password"
                            required
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Votre mot de passe"
                        >
                    </div>
                    <a href="{{ route('resetpassword')}}" class="text-blue-600 text-sm float-right mt-2 hover:underline">
                        Mot de passe oublié?
                    </a>
                </div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Connexion
                </button>
                <div class="text-center">
                    <p class="text-gray-600">
                        Pas de compte? 
                        <a href="{{ route('register')}}" class="text-blue-600 hover:underline">
                            Inscrivez-vous
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>