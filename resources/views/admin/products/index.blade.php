@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Manage Products</h1>
                <p class="text-gray-400 text-lg">Manage your coffee product catalog</p>
            </div>
            <a href="{{ route('admin.products.create') }}" 
               class="bg-amber-600 text-black px-6 py-3 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold mt-4 sm:mt-0 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Product
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 mb-8">
        <form method="GET" action="{{ route('admin.products.index') }}" class="space-y-4">
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
                    <label for="status" class="block text-gray-300 text-sm font-medium mb-2">Status</label>
                    <select name="status" id="status" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">All Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
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
                        <option value="stock" {{ request('sort') == 'stock' ? 'selected' : '' }}>Stock Low-High</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest First</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4">
                <button type="submit" 
                        class="bg-amber-600 text-black px-6 py-2 rounded-lg hover:bg-amber-500 transition-colors duration-200 font-semibold">
                    Apply Filters
                </button>
                <a href="{{ route('admin.products.index') }}" 
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

    <!-- Products Table -->
    @if($products->count() > 0)
    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-700/30 border-b border-gray-600">
                    <tr>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Product</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Category</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Price</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Stock</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Status</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Created</th>
                        <th class="px-6 py-4 text-center text-gray-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-700/30 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-12 h-12 object-cover rounded-lg">
                                @else
                                <div class="w-12 h-12 bg-gradient-to-br from-gray-600 to-gray-700 rounded-lg flex items-center justify-center">
                                    <span class="text-sm">☕</span>
                                </div>
                                @endif
                                <div>
                                    <h3 class="font-semibold text-gray-100">{{ $product->name }}</h3>
                                    <p class="text-gray-400 text-sm">{{ $product->origin }} • {{ $product->roast_level }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-gray-600/50 text-gray-300 px-3 py-1 rounded-full text-sm">
                                {{ $product->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-amber-400 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="{{ $product->stock <= 10 ? 'text-red-400' : ($product->stock <= 50 ? 'text-yellow-400' : 'text-green-400') }} font-semibold">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                       @if($product->is_available) bg-green-600/20 text-green-400 @else bg-red-600/20 text-red-400 @endif">
                                {{ $product->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-400 text-sm">{{ $product->created_at->format('M j, Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.products.show', $product) }}" 
                                   class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="bg-amber-600 text-black p-2 rounded-lg hover:bg-amber-500 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 text-white p-2 rounded-lg hover:bg-red-500 transition-colors duration-200"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="text-8xl mb-6">☕</div>
        <h3 class="text-3xl font-semibold text-gray-300 mb-4">No Products Found</h3>
        <p class="text-gray-400 text-lg mb-8">Try adjusting your search criteria or add your first product.</p>
        <a href="{{ route('admin.products.create') }}" 
           class="bg-amber-600 text-black px-8 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold inline-block transform hover:scale-105">
            Add Your First Product
        </a>
    </div>
    @endif
</div>
@endsection 