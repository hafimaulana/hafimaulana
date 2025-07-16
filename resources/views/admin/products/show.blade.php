@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" 
           class="text-amber-400 hover:text-amber-300 transition-colors duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Products
        </a>
    </div>

    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Product Details</h1>
                <p class="text-gray-400 text-lg">{{ $product->name }}</p>
            </div>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <a href="{{ route('admin.products.edit', $product) }}" 
                   class="bg-amber-600 text-black px-6 py-3 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Product
                </a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-500 transition-all duration-300 font-semibold inline-flex items-center"
                            onclick="return confirm('Are you sure you want to delete this product?')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Product Image -->
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Product Image</h2>
            
            @if($product->image)
            <div class="relative">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-96 object-cover rounded-xl">
                <div class="absolute top-4 right-4">
                    <span class="bg-amber-600 text-black px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $product->roast_level }}
                    </span>
                </div>
            </div>
            @else
            <div class="w-full h-96 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center">
                <div class="text-center">
                    <span class="text-8xl mb-4 block">☕</span>
                    <span class="text-gray-400 text-lg">No Image Available</span>
                </div>
            </div>
            @endif
        </div>

        <!-- Product Information -->
        <div class="space-y-8">
            <!-- Basic Information -->
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Basic Information</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Product Name:</span>
                        <span class="text-gray-100 font-semibold">{{ $product->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Category:</span>
                        <span class="bg-gray-600/50 text-gray-300 px-3 py-1 rounded-full text-sm">
                            {{ $product->category }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Origin:</span>
                        <span class="text-gray-100">{{ $product->origin }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Roast Level:</span>
                        <span class="bg-amber-600/20 text-amber-400 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $product->roast_level }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Pricing & Stock -->
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Pricing & Stock</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Price:</span>
                        <span class="text-amber-400 font-bold text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Stock:</span>
                        <span class="{{ $product->stock <= 10 ? 'text-red-400' : ($product->stock <= 50 ? 'text-yellow-400' : 'text-green-400') }} font-semibold">
                            {{ $product->stock }} units
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Status:</span>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{
                            $product->is_available ? 'bg-green-600/20 text-green-400' : 'bg-red-600/20 text-red-400'
                        }}">
                            {{ $product->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            @if($product->processing_method || $product->altitude)
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Additional Information</h2>
                
                <div class="space-y-4">
                    @if($product->processing_method)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Processing Method:</span>
                        <span class="text-gray-100">{{ $product->processing_method }}</span>
                    </div>
                    @endif
                    @if($product->altitude)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 font-medium">Altitude:</span>
                        <span class="text-gray-100">{{ $product->altitude }} masl</span>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Description -->
    <div class="mt-8">
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Product Description</h2>
            
            <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-6">
                <p class="text-gray-300 leading-relaxed text-lg">{{ $product->description }}</p>
            </div>
        </div>
    </div>

    <!-- Product Statistics -->
    <div class="mt-8">
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Product Statistics</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4 text-center">
                    <div class="text-3xl font-bold text-amber-400 mb-2">{{ $totalOrders }}</div>
                    <p class="text-gray-400">Total Orders</p>
                </div>
                <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4 text-center">
                    <div class="text-3xl font-bold text-blue-400 mb-2">{{ $totalQuantity }}</div>
                    <p class="text-gray-400">Total Quantity Sold</p>
                </div>
                <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4 text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    <p class="text-gray-400">Total Revenue</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    @if($recentOrders->count() > 0)
    <div class="mt-8">
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
            <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Recent Orders</h2>
            
            <div class="space-y-4">
                @foreach($recentOrders as $order)
                <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-100">Order #{{ $order->order_number }}</h3>
                            <p class="text-gray-400 text-sm">{{ $order->customer->name }} • {{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-amber-400 font-bold">Qty: {{ $order->pivot->quantity }}</p>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{
                                $order->status === 'pending' ? 'bg-yellow-600/20 text-yellow-400' :
                                ($order->status === 'processing' ? 'bg-blue-600/20 text-blue-400' :
                                ($order->status === 'shipped' ? 'bg-purple-600/20 text-purple-400' :
                                ($order->status === 'delivered' ? 'bg-green-600/20 text-green-400' :
                                ($order->status === 'cancelled' ? 'bg-red-600/20 text-red-400' : ''))))
                            }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 