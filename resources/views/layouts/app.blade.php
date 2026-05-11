<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }} — @yield('title', 'Dashboard')</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 font-sans antialiased">

        <nav class="bg-white border-b shadow-sm">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16 items-center">

                    <div>
                        LeaveApp
                    </div>

                    <div>
                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-4 py-8">
            @yield('content')
        </main>

    </body>
</html>
