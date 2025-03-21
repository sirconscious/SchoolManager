<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')

    <title>Document</title>
</head>
<body >
    
{{-- The navBar --}}

{{-- <nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SchoolManger</span>
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="#" class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Login</a>
        </div>
    </div>
</nav> --}}
<div class=" w-full flex gap-4 h-screen justify-center flex-col items-center">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse ">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-15" alt="Flowbite Logo" />
        <span class="self-center text-5xl font-semibold whitespace-nowrap dark:text-white">SchoolManger</span>
    </a>
    @yield('content') 
</div>

</body>
</html>