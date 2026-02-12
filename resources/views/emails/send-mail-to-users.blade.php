<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Ensures compatibility with most email clients */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>
<body class="bg-gray-100 p-4 sm:p-6 md:p-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">
        
        <!-- Header with a gradient background -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-8 text-white text-center">
            <h1 class="text-4xl font-extrabold mb-2">{{ $title }}</h1>
            <p class="text-lg opacity-90">We're excited to have you on board!</p>
        </div>
        
        <!-- Main Content -->
        <div class="p-8 md:p-10">
            <p class="text-xl text-gray-800 mb-6">
                Hello, <strong>{{ $user->name }}</strong>!
            </p>

            <!-- Message Body -->
            <div class="text-gray-700 leading-relaxed text-base border-l-4 border-blue-500 pl-4 mb-8">
                {!! $body !!}
            </div>

            <!-- Call to Action Button -->
            <div class="text-center">
                <a href="{{ url('/') }}" 
                   class="inline-block bg-blue-600 text-white font-bold px-10 py-3 rounded-full shadow-lg transform hover:scale-105 transition-transform duration-300">
                    🚀 Get Started Now
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 p-6 border-t border-gray-200 text-center text-gray-500">
            <p class="text-sm mb-2">
                If you need assistance, feel free to <a href="mailto:support@example.com" class="text-blue-600 hover:underline">contact our support team</a>.
            </p>
            <p class="text-xs">
                &copy; {{ date('Y') }} Task Manager. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
