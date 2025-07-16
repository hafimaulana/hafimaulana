@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Our Coffee Collection</h1>
        <p class="text-gray-400 text-lg">Discover our premium selection of carefully roasted coffee beans</p>
    </div>

    <!-- Filters Section -->
    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 mb-8">
        <form method="GET" action="{{ route('products.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-gray-300 text-sm font-medium mb-2">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           placeholder="Search products..." 
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label for="category" class="block text-gray-300 text-sm font-medium mb-2">Category</label>
                    <select name="category" id="category" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="roast_level" class="block text-gray-300 text-sm font-medium mb-2">Roast Level</label>
                    <select name="roast_level" id="roast_level" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">All Roast Levels</option>
                        @foreach($roastLevels as $level)
                        <option value="{{ $level }}" {{ request('roast_level') == $level ? 'selected' : '' }}>
                            {{ $level }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="sort" class="block text-gray-300 text-sm font-medium mb-2">Sort By</label>
                    <select name="sort" id="sort" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price Low-High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price High-Low</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest First</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4">
                <button type="submit" 
                        class="bg-amber-600 text-black px-6 py-2 rounded-lg hover:bg-amber-500 transition-colors duration-200 font-semibold">
                    Apply Filters
                </button>
                <a href="{{ route('products.index') }}" 
                   class="bg-gray-600 text-gray-100 px-6 py-2 rounded-lg hover:bg-gray-500 transition-colors duration-200 font-semibold">
                    Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Results Summary -->
    <div class="mb-6">
        <p class="text-gray-400">
            Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
        </p>
    </div>

    <!-- Products Grid -->
    @if($products->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300 group">
            <div class="relative overflow-hidden">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                <div class="w-full h-64 bg-gradient-to-br from-gray-600 to-gray-700 flex items-center justify-center">
                    <div class="text-center">
                        <span class="text-6xl mb-2 block">☕</span>
                        <span class="text-gray-400 text-sm">No Image</span>
                    </div>
                </div>
                @endif
                <div class="absolute top-4 right-4">
                    <span class="bg-amber-600 text-black px-3 py-1 rounded-full text-xs font-semibold">
                        {{ $product->roast_level }}
                    </span>
                </div>
                @if($product->stock <= 0)
                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                    <span class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold">Out of Stock</span>
                </div>
                @endif
            </div>
            <div class="p-6">
                <h3 class="font-semibold text-gray-100 mb-2 group-hover:text-amber-400 transition-colors text-lg">{{ $product->name }}</h3>
                <p class="text-gray-400 text-sm mb-3">{{ $product->origin }} • {{ $product->roast_level }}</p>
                <p class="text-gray-300 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                <div class="flex justify-between items-center mb-4">
                    <p class="text-amber-400 font-bold text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <span class="text-gray-400 text-sm">
                        Stock: {{ $product->stock }}
                    </span>
                </div>
                <div class="space-y-2">
                    <a href="{{ route('products.show', $product) }}" 
                       class="w-full bg-amber-600 text-black px-4 py-3 rounded-lg hover:bg-amber-500 transition-colors duration-200 text-center font-medium block">
                        View Details
                    </a>
                    @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-gray-600 text-gray-100 px-4 py-3 rounded-lg hover:bg-gray-500 transition-colors duration-200 font-medium">
                            Add to Cart
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $products->links() }}
    </div>
    @else
    <div class="text-center py-16">
        <div class="text-8xl mb-6">☕</div>
        <h3 class="text-3xl font-semibold text-gray-300 mb-4">No Products Found</h3>
        <p class="text-gray-400 text-lg mb-8">Try adjusting your search criteria or browse our full collection.</p>
        <a href="{{ route('products.index') }}" 
           class="bg-amber-600 text-black px-8 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold inline-block">
            View All Products
        </a>
    </div>
    @endif
</div>
@endsection 