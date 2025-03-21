<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
    <title>SchoolManager</title>
</head>
<body class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-900 dark:to-gray-800">
    <!-- Main Container -->
    <div class="min-h-screen w-full flex flex-col justify-center items-center p-4">
        <!-- Logo and Title -->
        <div class="text-center mb-8 transform transition-transform duration-500 hover:scale-105">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-20 w-20" alt="Flowbite Logo" />
                <span class="self-center text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent dark:from-blue-400 dark:to-purple-400">
                    SchoolManager
                </span>
            </a>
        </div>

        <!-- Content Section -->
        <div class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8">
            @yield('content')
        </div>

        <footer class="mt-8 text-center text-gray-600 dark:text-gray-400">
            <p>&copy; 2023 SchoolManager. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>