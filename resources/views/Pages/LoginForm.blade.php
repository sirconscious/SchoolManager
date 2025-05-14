@extends('Layouts.LoginLayout')
@section('content')

@if (session()->has('success'))
    <div id="success-message" class="fixed top-8 left-1/2 transform -translate-x-1/2 bg-emerald-500 text-white px-6 py-4 rounded-xl shadow-lg z-50 flex items-center space-x-3 opacity-100 transition-all duration-500 border border-emerald-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"></path>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

<!-- Header -->
<div class="text-center mb-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
        Welcome back
    </h2>
    <p class="text-sm text-gray-600 dark:text-gray-400">
        Sign in to your account
    </p>
</div>

<!-- Form -->
<form class="space-y-6" action="{{route('user.login')}}" method="POST">
    @csrf
    
    <!-- Email Field -->
    <div>
        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Email address
        </label>
        <div class="relative">
            <input type="email" name="email" required
                   class="appearance-none relative block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm"
                   placeholder="Enter your email">
        </div>
    </div>

    <!-- Password Field -->
    <div>
        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
            Password
        </label>
        <div class="relative">
            <input type="password" name="password" required
                   class="appearance-none relative block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white rounded-lg bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-sm"
                   placeholder="Enter your password">
        </div>
    </div>

    <!-- Submit Button -->
    <div>
        <button type="submit"
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200 transition duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </span>
            Sign in
        </button>
    </div>

    <!-- Error Message -->
    @if ($errors->has('login_error'))
        <div class="rounded-lg bg-red-50 dark:bg-red-900/20 p-4 border border-red-200 dark:border-red-800">
            <div class="flex">
                <svg class="w-5 h-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800 dark:text-red-200">
                        {{ $errors->first('login_error') }}
                    </p>
                </div>
            </div>
        </div>
    @endif
</form>

<script>
    // Auto-hide success message
    setTimeout(function() {
        const message = document.getElementById('success-message');
        if (message) {
            message.style.opacity = '0';
            message.style.transform = 'translate(-50%, -20px)';
            setTimeout(function() {
                message.remove();
            }, 500);
        }
    }, 3000);
</script>

@endsection