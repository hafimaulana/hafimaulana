<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dark Roast Coffee') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|inter:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-900 text-gray-100">
        <div class="min-h-screen">
            <!-- Navigation -->
            <nav class="bg-black border-b border-amber-900/30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ route('home') }}" class="text-2xl font-bold text-amber-400 font-serif">
                                ☕ Dark Roast
                            </a>
                        </div>
                        <div class="flex items-center space-x-6">
                            <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-amber-400 transition-colors duration-200">Products</a>
                            @auth
                                @if(auth()->user()->role->name === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-amber-400 transition-colors duration-200">Admin Dashboard</a>
                                @else
                                    <a href="{{ route('customer.dashboard') }}" class="text-gray-300 hover:text-amber-400 transition-colors duration-200">Dashboard</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-300 hover:text-amber-400 transition-colors duration-200">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-300 hover:text-amber-400 transition-colors duration-200">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-amber-600 text-black px-4 py-2 rounded-md hover:bg-amber-500 transition-colors duration-200 font-medium">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="bg-gray-900">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-black border-t border-amber-900/30 py-12 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-amber-400 font-serif text-xl font-bold mb-4">Dark Roast Coffee</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Premium coffee beans from the finest regions, roasted to perfection for the ultimate coffee experience.
                            </p>
                        </div>
                        <div>
                            <h4 class="text-amber-400 font-medium mb-4">Quick Links</h4>
                            <ul class="space-y-2 text-sm">
                                <li><a href="{{ route('products.index') }}" class="text-gray-400 hover:text-amber-400 transition-colors">Our Products</a></li>
                                <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-amber-400 transition-colors">Home</a></li>
                                @auth
                                    <li><a href="{{ route('customer.profile') }}" class="text-gray-400 hover:text-amber-400 transition-colors">My Profile</a></li>
                                @endauth
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-amber-400 font-medium mb-4">Contact</h4>
                            <div class="text-gray-400 text-sm space-y-2">
                                <p>Email: info@darkroast.com</p>
                                <p>Phone: +62 21 1234 5678</p>
                                <p>Address: Jakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-amber-900/30 mt-8 pt-8 text-center">
                        <p class="text-gray-500 text-sm">&copy; 2024 Dark Roast Coffee. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
