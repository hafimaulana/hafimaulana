@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Customer Dashboard</h1>
        <p class="text-gray-400 text-lg">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-amber-900/20 to-black/50 border border-amber-900/30 rounded-2xl p-8 mb-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-amber-400 mb-4 font-serif">Discover Our Premium Coffee Collection</h2>
            <p class="text-gray-300 text-lg mb-8 leading-relaxed">Explore our carefully selected coffee beans from the finest regions around the world, each roasted to perfection for the ultimate coffee experience.</p>
            <a href="{{ route('products.index') }}" 
               class="bg-amber-600 text-black px-8 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold inline-block transform hover:scale-105">
                Browse Products
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-6 text-center hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300">
            <div class="text-4xl font-bold text-amber-400 mb-2">{{ $totalProducts }}</div>
            <p class="text-gray-400">Available Products</p>
        </div>
        <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-6 text-center hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300">
            <div class="text-4xl font-bold text-green-400 mb-2">{{ $availableProducts }}</div>
            <p class="text-gray-400">In Stock</p>
        </div>
        <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-6 text-center hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300">
            <div class="text-4xl font-bold text-blue-400 mb-2">{{ $productCategories }}</div>
            <p class="text-gray-400">Categories</p>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-8 mb-8">
        <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Featured Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredProducts as $product)
            <div class="bg-gray-700/30 border border-gray-600 rounded-xl overflow-hidden hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300 group">
                <div class="relative overflow-hidden">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-gray-600 to-gray-700 flex items-center justify-center">
                        <div class="text-center">
                            <span class="text-4xl mb-2 block">☕</span>
                            <span class="text-gray-400 text-sm">No Image</span>
                        </div>
                    </div>
                    @endif
                    <div class="absolute top-4 right-4">
                        <span class="bg-amber-600 text-black px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $product->roast_level }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-gray-100 mb-2 group-hover:text-amber-400 transition-colors">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm mb-3">{{ $product->origin }} • {{ $product->roast_level }}</p>
                    <p class="text-amber-400 font-bold text-lg mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.show', $product) }}" 
                       class="w-full bg-amber-600 text-black px-4 py-2 rounded-lg hover:bg-amber-500 transition-colors duration-200 text-center font-medium block">
                        View Details
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-6xl mb-4">☕</div>
                <h3 class="text-2xl font-semibold text-gray-300 mb-2">No Featured Products</h3>
                <p class="text-gray-400">We're currently preparing our featured collection. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-8">
        <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('products.index') }}" 
               class="bg-gradient-to-r from-amber-600 to-amber-700 text-black px-6 py-4 rounded-xl hover:from-amber-500 hover:to-amber-600 transition-all duration-300 text-center font-semibold transform hover:scale-105">
                <div class="text-2xl mb-2">☕</div>
                Browse All Products
            </a>
            <a href="{{ route('customer.profile') }}" 
               class="bg-gradient-to-r from-gray-600 to-gray-700 text-gray-100 px-6 py-4 rounded-xl hover:from-gray-500 hover:to-gray-600 transition-all duration-300 text-center font-semibold transform hover:scale-105">
                <div class="text-2xl mb-2">👤</div>
                My Profile
            </a>
        </div>
    </div>
</div>
@endsection 