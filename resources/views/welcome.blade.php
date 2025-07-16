<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dark Roast Coffee - Premium Coffee Experience</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700|inter:400,500,600" rel="stylesheet" />
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-900 text-gray-100">
        <!-- Navigation -->
        <nav class="bg-black/90 backdrop-blur-sm border-b border-amber-900/30 fixed w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-amber-400 font-serif">☕ Dark Roast</h1>
                    </div>
                    <div class="flex items-center space-x-6">
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

        <!-- Hero Section -->
        <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-amber-900/20"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23d97706" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
            
            <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-bold mb-8 font-serif">
                    <span class="text-amber-400">Dark Roast</span>
                    <span class="text-gray-100">Coffee</span>
                </h1>
                <p class="text-xl md:text-2xl mb-12 text-gray-300 leading-relaxed max-w-3xl mx-auto">
                    Experience the bold, rich flavors of premium coffee beans from Indonesia's finest regions. 
                    Each cup tells a story of tradition, passion, and excellence.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="bg-amber-600 text-black px-8 py-4 rounded-lg font-semibold hover:bg-amber-500 transition-all duration-300 transform hover:scale-105">
                        Explore Our Collection
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="border-2 border-amber-400 text-amber-400 px-8 py-4 rounded-lg font-semibold hover:bg-amber-400 hover:text-black transition-all duration-300">
                            Join the Experience
                        </a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-24 bg-black/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-amber-400 mb-4 font-serif">Why Choose Dark Roast?</h2>
                    <p class="text-gray-400 text-lg">Premium quality meets exceptional taste</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="text-center group">
                        <div class="bg-gradient-to-br from-amber-900/30 to-amber-600/20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-3xl">🌱</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-amber-400">Premium Quality</h3>
                        <p class="text-gray-400 leading-relaxed">Carefully selected beans from the finest coffee regions, ensuring every cup delivers exceptional flavor and aroma.</p>
                    </div>
                    <div class="text-center group">
                        <div class="bg-gradient-to-br from-amber-900/30 to-amber-600/20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-3xl">🏔️</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-amber-400">High Altitude</h3>
                        <p class="text-gray-400 leading-relaxed">Grown in high-altitude regions where the perfect climate creates beans with superior complexity and depth.</p>
                    </div>
                    <div class="text-center group">
                        <div class="bg-gradient-to-br from-amber-900/30 to-amber-600/20 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-3xl">🌿</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-amber-400">Artisan Roasted</h3>
                        <p class="text-gray-400 leading-relaxed">Expertly roasted by master roasters who understand the perfect balance of time, temperature, and technique.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-24 bg-gradient-to-r from-amber-900/20 to-black">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl font-bold text-amber-400 mb-6 font-serif">Ready to Experience Dark Roast?</h2>
                <p class="text-xl text-gray-300 mb-8">Join thousands of coffee enthusiasts who have discovered the perfect cup.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-amber-600 text-black px-8 py-4 rounded-lg font-semibold hover:bg-amber-500 transition-all duration-300 transform hover:scale-105">
                    Start Your Journey
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-black border-t border-amber-900/30 py-12">
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
    </body>
</html>
