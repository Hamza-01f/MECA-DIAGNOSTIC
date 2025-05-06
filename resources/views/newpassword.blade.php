<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du Mot de Passe - Atelier Mécanique</title>
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
                    <i class="fas fa-lock-open mr-3"></i>
                    Réinitialisation du Mot de Passe
                </h1>
            </div>
            <form class="p-8 space-y-6" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div>
                    <label class="block text-gray-700 mb-2">Nouveau Mot de Passe</label>
                    <div class="relative">
                        <i class="fas fa-key absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="password"
                            required
                            minlength="8"
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Entrez votre nouveau mot de passe"
                        >
                    </div>
                    <p class="text-sm text-gray-600 mt-1">
                        Le mot de passe doit contenir au moins 8 caractères
                    </p>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Confirmer le Mot de Passe</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="password_confirmation"
                            required
                            minlength="8"
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Confirmez votre nouveau mot de passe"
                        >
                    </div>
                    <p class="text-sm text-gray-600 mt-1">
                        Assurez-vous que les mots de passe correspondent
                    </p>
                </div>
                
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors"
                >
                    Réinitialiser le Mot de Passe
                </button>
                
                <div class="text-center">
                    <p class="text-gray-600">
                        Vous vous souvenez de votre mot de passe? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                            Connectez-vous
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]');
            const confirmPassword = document.querySelector('input[name="password_confirmation"]');
            
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas.');
                confirmPassword.classList.add('border-red-500');
            } else {
                confirmPassword.classList.remove('border-red-500');
            }
        });
    </script>
</body>
</html>
