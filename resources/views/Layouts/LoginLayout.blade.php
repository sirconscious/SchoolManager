<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
    <title>SchoolManager</title>
    <style>
        .bg-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(99, 102, 241, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.05) 0%, transparent 50%);
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-blue-900 dark:to-indigo-900 bg-pattern min-h-screen">
    <!-- Decorative elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/10 to-purple-600/10 rounded-full blur-3xl floating"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-purple-400/10 to-pink-600/10 rounded-full blur-3xl floating" style="animation-delay: -3s;"></div>
        <div class="absolute top-20 left-20 w-40 h-40 bg-gradient-to-br from-yellow-400/5 to-orange-600/5 rounded-full blur-2xl floating" style="animation-delay: -1.5s;"></div>
    </div>

    <!-- Main Container -->
    <div class="relative min-h-screen w-full flex flex-col justify-center items-center p-4">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <div class="relative">
                <!-- Glow effect behind logo -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-full blur-2xl transform scale-150"></div>
                
                <div class="relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/50 transform transition-all duration-500 hover:scale-105 hover:rotate-1">
                    <a href="http://localhost:5174/" class="flex flex-col items-center space-y-4">
                        <div class="relative">
            <div class="h-10 w-10 bg-[rgb(0_240_255)] text-indigo-950 rounded-md flex items-center justify-center mr-3" style="transform: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-atom h-6 w-6 text-dark-900"><circle cx="12" cy="12" r="1"></circle><path d="M20.2 20.2c2.04-2.03.02-7.36-4.5-11.9-4.54-4.52-9.87-6.54-11.9-4.5-2.04 2.03-.02 7.36 4.5 11.9 4.54 4.52 9.87 6.54 11.9 4.5Z"></path><path d="M15.7 15.7c4.52-4.54 6.54-9.87 4.5-11.9-2.03-2.04-7.36-.02-11.9 4.5-4.52 4.54-6.54 9.87-4.5 11.9 2.03 2.04 7.36.02 11.9-4.5Z"></path></svg></div>
                            <div class="absolute -inset-2 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full opacity-20 blur animate-pulse"></div>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent dark:from-blue-400 dark:via-purple-400 dark:to-indigo-400 tracking-tight">
                            SCHOOL ACADEMY
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium tracking-wide">
                            Modern Education Management System
                        </p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="w-full max-w-md mx-auto">
            <div class="relative">
                <!-- Subtle border glow -->
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-2xl blur-sm"></div>
                
                <!-- Main card -->
                <div class="relative bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/50 dark:border-gray-700/50 overflow-hidden">
                    <!-- Card header with subtle gradient -->
                    <div class="h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500"></div>
                    
                    <div class="p-8">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Footer -->
        <footer class="mt-12 text-center">
            <div class="flex items-center justify-center space-x-2 text-gray-500 dark:text-gray-400 mb-4">
                <div class="flex space-x-1">
                    <div class="w-1 h-1 bg-blue-500 rounded-full animate-pulse"></div>
                    <div class="w-1 h-1 bg-purple-500 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                    <div class="w-1 h-1 bg-indigo-500 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                </div>
            </div>
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                &copy; {{ date('Y') }} SchoolManager. All rights reserved.
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">
                Crafted with ❤️ for modern education
            </p>
        </footer>
    </div>
</body>
</html>