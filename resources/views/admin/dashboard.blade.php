@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Admin Dashboard</h1>
        <p class="text-gray-400 text-lg">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Products</p>
                    <p class="text-3xl font-bold text-amber-400">{{ $totalProducts }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-600/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-400 text-sm font-medium">+{{ $newProductsThisMonth }}</span>
                <span class="text-gray-400 text-sm">this month</span>
            </div>
        </div>

        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Orders</p>
                    <p class="text-3xl font-bold text-blue-400">{{ $totalOrders }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-600/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-400 text-sm font-medium">+{{ $newOrdersThisMonth }}</span>
                <span class="text-gray-400 text-sm">this month</span>
            </div>
        </div>

        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Revenue</p>
                    <p class="text-3xl font-bold text-green-400">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-600/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-400 text-sm font-medium">+{{ number_format($revenueGrowth, 1) }}%</span>
                <span class="text-gray-400 text-sm">vs last month</span>
            </div>
        </div>

        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 hover:shadow-2xl hover:shadow-amber-900/20 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Customers</p>
                    <p class="text-3xl font-bold text-purple-400">{{ $totalCustomers }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-600/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-400 text-sm font-medium">+{{ $newCustomersThisMonth }}</span>
                <span class="text-gray-400 text-sm">this month</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Recent Orders -->
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-amber-400 font-serif">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" 
                   class="text-amber-400 hover:text-amber-300 transition-colors duration-200 text-sm font-medium">
                    View All
                </a>
            </div>
            
            <div class="space-y-4">
                @forelse($recentOrders as $order)
                <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-100">Order #{{ $order->order_number }}</h3>
                            <p class="text-gray-400 text-sm">{{ $order->customer->name }} • {{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-amber-400 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
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
                @empty
                <div class="text-center py-8">
                    <div class="text-4xl mb-2">📦</div>
                    <p class="text-gray-400">No recent orders</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-amber-400 font-serif">Low Stock Alert</h2>
                <a href="{{ route('admin.products.index') }}" 
                   class="text-amber-400 hover:text-amber-300 transition-colors duration-200 text-sm font-medium">
                    View All
                </a>
            </div>
            
            <div class="space-y-4">
                @forelse($lowStockProducts as $product)
                <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-10 h-10 object-cover rounded-lg">
                            @else
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-600 to-gray-700 rounded-lg flex items-center justify-center">
                                <span class="text-sm">☕</span>
                            </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-gray-100">{{ $product->name }}</h3>
                                <p class="text-gray-400 text-sm">{{ $product->origin }} • {{ $product->roast_level }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-red-400 font-bold">{{ $product->stock }}</p>
                            <p class="text-gray-400 text-xs">in stock</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="text-4xl mb-2">✅</div>
                    <p class="text-gray-400">All products well stocked</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
        <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Quick Actions</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.products.create') }}" 
               class="bg-gradient-to-r from-amber-600 to-amber-700 text-black px-6 py-4 rounded-xl hover:from-amber-500 hover:to-amber-600 transition-all duration-300 text-center font-semibold transform hover:scale-105">
                <div class="text-2xl mb-2">➕</div>
                Add Product
            </a>
            
            <a href="{{ route('admin.orders.index') }}" 
               class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-xl hover:from-blue-500 hover:to-blue-600 transition-all duration-300 text-center font-semibold transform hover:scale-105">
                <div class="text-2xl mb-2">📋</div>
                Manage Orders
            </a>
            
            <a href="{{ route('admin.customers') }}" 
               class="bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-4 rounded-xl hover:from-purple-500 hover:to-purple-600 transition-all duration-300 text-center font-semibold transform hover:scale-105">
                <div class="text-2xl mb-2">👥</div>
                View Customers
            </a>
            
            <a href="{{ route('admin.reports.index') }}" 
               class="bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 rounded-xl hover:from-green-500 hover:to-green-600 transition-all duration-300 text-center font-semibold transform hover:scale-105">
                <div class="text-2xl mb-2">📊</div>
                View Reports
            </a>
        </div>
    </div>
</div>
@endsection 