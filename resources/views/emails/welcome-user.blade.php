<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto mt-10 bg-white rounded-lg shadow-lg p-8">
        <div class="flex items-center mb-6">
            <svg class="h-10 w-10 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4"></path>
            </svg>
            <h1 class="text-2xl font-bold text-gray-800">Welcome to Task Manager!</h1>
        </div>
        <p class="text-gray-700 mb-4">
            Hi {{ $user->name }},
        </p>
        <p class="text-gray-700 mb-6">
            We're excited to have you on board. Task Manager helps you organize your tasks efficiently and boost your productivity.
        </p>
        <a href="{{ url('/') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Get Started
        </a>
        <p class="text-gray-500 text-sm mt-8">
            If you have any questions, feel free to reply to this email.
        </p>
        <p class="text-gray-400 text-xs mt-2">
            &copy; {{ date('Y') }} Task Manager. All rights reserved.
        </p>
    </div>
</body>
</html>
