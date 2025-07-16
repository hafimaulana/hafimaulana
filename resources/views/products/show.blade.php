@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('products.index') }}" 
           class="text-amber-400 hover:text-amber-300 transition-colors duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Products
        </a>
    </div>

    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
            <!-- Product Image -->
            <div class="relative overflow-hidden">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                     class="w-full h-96 lg:h-full object-cover">
                @else
                <div class="w-full h-96 lg:h-full bg-gradient-to-br from-gray-600 to-gray-700 flex items-center justify-center">
                    <div class="text-center">
                        <span class="text-8xl mb-4 block">☕</span>
                        <span class="text-gray-400 text-lg">No Image Available</span>
                    </div>
                </div>
                @endif
                <div class="absolute top-4 left-4">
                    <span class="bg-amber-600 text-black px-4 py-2 rounded-full text-sm font-semibold">
                        {{ $product->roast_level }}
                    </span>
                </div>
            </div>

            <!-- Product Details -->
            <div class="p-8">
                <h1 class="text-3xl font-bold text-amber-400 mb-4 font-serif">{{ $product->name }}</h1>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-center text-gray-300">
                        <span class="font-semibold w-24">Origin:</span>
                        <span>{{ $product->origin }}</span>
                    </div>
                    <div class="flex items-center text-gray-300">
                        <span class="font-semibold w-24">Roast Level:</span>
                        <span class="bg-amber-600/20 text-amber-400 px-3 py-1 rounded-full text-sm">
                            {{ $product->roast_level }}
                        </span>
                    </div>
                    <div class="flex items-center text-gray-300">
                        <span class="font-semibold w-24">Category:</span>
                        <span>{{ $product->category }}</span>
                    </div>
                    <div class="flex items-center text-gray-300">
                        <span class="font-semibold w-24">Stock:</span>
                        <span class="{{ $product->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ $product->stock > 0 ? $product->stock . ' available' : 'Out of Stock' }}
                        </span>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-100 mb-3">Description</h3>
                    <p class="text-gray-300 leading-relaxed">{{ $product->description }}</p>
                </div>

                <div class="mb-8">
                    <div class="text-4xl font-bold text-amber-400 mb-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                    <p class="text-gray-400 text-sm">Price per unit</p>
                </div>

                @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <label for="quantity" class="text-gray-300 font-semibold">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                               class="w-20 bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-gray-100 text-center focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <button type="submit" 
                            class="w-full bg-amber-600 text-black px-6 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold text-lg transform hover:scale-105">
                        Add to Cart
                    </button>
                </form>
                @else
                <div class="bg-red-600/20 border border-red-600/30 rounded-xl p-4 text-center">
                    <p class="text-red-400 font-semibold">This product is currently out of stock</p>
                    <p class="text-gray-400 text-sm mt-1">Check back later for availability</p>
                </div>
                @endif

                <!-- Additional Actions -->
                <div class="mt-8 pt-6 border-t border-gray-700">
                    <div class="flex space-x-4">
                        <a href="{{ route('products.index') }}" 
                           class="flex-1 bg-gray-600 text-gray-100 px-4 py-3 rounded-lg hover:bg-gray-500 transition-colors duration-200 text-center font-medium">
                            Continue Shopping
                        </a>
                        <a href="{{ route('cart.index') }}" 
                           class="flex-1 bg-gray-700 text-gray-100 px-4 py-3 rounded-lg hover:bg-gray-600 transition-colors duration-200 text-center font-medium">
                            View Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    @if($relatedProducts->count() > 0)
    <div class="mt-16">
        <h2 class="text-2xl font-semibold text-amber-400 mb-8 font-serif">You Might Also Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-gray-800/50 border border-gray-700 rounded-xl overflow-hidden hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300 group">
                <div class="relative overflow-hidden">
                    @if($relatedProduct->image)
                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" 
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
                            {{ $relatedProduct->roast_level }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="font-semibold text-gray-100 mb-2 group-hover:text-amber-400 transition-colors">{{ $relatedProduct->name }}</h3>
                    <p class="text-gray-400 text-sm mb-3">{{ $relatedProduct->origin }} • {{ $relatedProduct->roast_level }}</p>
                    <p class="text-amber-400 font-bold text-lg mb-4">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.show', $relatedProduct) }}" 
                       class="w-full bg-amber-600 text-black px-4 py-2 rounded-lg hover:bg-amber-500 transition-colors duration-200 text-center font-medium block">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection 