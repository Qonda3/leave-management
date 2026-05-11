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

        {{-- Navigation --}}
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">

                    {{-- Logo --}}
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-gray-900">LeaveApp</span>
                    </div>

                    {{-- Nav Links --}}
                    <div class="flex items-center gap-6">
                        <a href="{{ route('dashboard') }}"
                        class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }}">
                            Dashboard
                        </a>

                        @if(auth()->user()->isEmployee())
                            <a href="{{ route('leaves.index') }}"
                            class="text-sm font-medium {{ request()->routeIs('leaves.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }}">
                                My Leaves
                            </a>
                            <a href="{{ route('leaves.create') }}"
                            class="text-sm font-medium text-gray-600 hover:text-gray-900">
                                Apply for Leave
                            </a>
                        @endif

                        @if(auth()->user()->isManager())
                            <a href="{{ route('manager.approvals') }}"
                            class="text-sm font-medium {{ request()->routeIs('manager.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }}">
                                Approvals
                            </a>
                            <a href="{{ route('leaves.index') }}"
                            class="text-sm font-medium {{ request()->routeIs('leaves.*') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }}">
                                My Leaves
                            </a>
                        @endif

                    </div>

                    {{-- User Menu --}}
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-indigo-600 capitalize font-medium">{{ auth()->user()->role }}</p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-sm text-gray-500 hover:text-red-600 font-medium transition-colors">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </nav>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        {{-- Page Content --}}
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>

    </body>
</html>
