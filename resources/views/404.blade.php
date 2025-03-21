<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f9a8d4' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-pattern bg-pink-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl overflow-hidden max-w-md w-full relative">
        <!-- Top decoration -->
        <div class="h-2 bg-gradient-to-r from-pink-500 to-purple-600"></div>
        
        <!-- Content container -->
        <div class="p-8">
            <!-- Search/magnifying glass image -->
            <div class="flex justify-center mb-6">
                <div class="w-32 h-32 relative float-animation">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-pink-500 w-full h-full">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        <path d="M11 8v6"></path>
                        <path d="M8 11h6"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Error message -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">404</h1>
                <h2 class="text-2xl font-semibold text-pink-600 mb-4">Page Not Found</h2>
                <p class="text-gray-600 mb-8">Sorry, the page you're looking for doesn't exist or has been moved. Please check the URL or navigate to another page.</p>
                
                <!-- Button -->
                <a href="/" class="inline-block bg-gradient-to-r from-pink-500 to-purple-600 text-white font-medium rounded-lg px-6 py-3 transition-transform transform hover:scale-105 hover:shadow-lg">
                    Return to Home
                </a>
            </div>
        </div>
        
        <!-- Bottom decoration -->
        <div class="p-4 bg-gray-50 border-t border-gray-100">
            <p class="text-center text-sm text-gray-500">
                If you believe this is an error, please contact support.
            </p>
        </div>
    </div>
</body>
</html>