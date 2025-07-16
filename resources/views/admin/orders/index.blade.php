@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Manage Orders</h1>
        <p class="text-gray-400 text-lg">Track and manage customer orders</p>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 mb-8">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-gray-300 text-sm font-medium mb-2">Search</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           placeholder="Search orders..." 
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label for="status" class="block text-gray-300 text-sm font-medium mb-2">Status</label>
                    <select name="status" id="status" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div>
                    <label for="payment_method" class="block text-gray-300 text-sm font-medium mb-2">Payment Method</label>
                    <select name="payment_method" id="payment_method" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">All Methods</option>
                        <option value="cash_on_delivery" {{ request('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                        <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="e_wallet" {{ request('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                </div>
                <div>
                    <label for="sort" class="block text-gray-300 text-sm font-medium mb-2">Sort By</label>
                    <select name="sort" id="sort" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest First</option>
                        <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Oldest First</option>
                        <option value="total_amount" {{ request('sort') == 'total_amount' ? 'selected' : '' }}>Amount Low-High</option>
                        <option value="total_amount_desc" {{ request('sort') == 'total_amount_desc' ? 'selected' : '' }}>Amount High-Low</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4">
                <button type="submit" 
                        class="bg-amber-600 text-black px-6 py-2 rounded-lg hover:bg-amber-500 transition-colors duration-200 font-semibold">
                    Apply Filters
                </button>
                <a href="{{ route('admin.orders.index') }}" 
                   class="bg-gray-600 text-gray-100 px-6 py-2 rounded-lg hover:bg-gray-500 transition-colors duration-200 font-semibold">
                    Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Results Summary -->
    <div class="mb-6">
        <p class="text-gray-400">
            Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} orders
        </p>
    </div>

    <!-- Orders Table -->
    @if($orders->count() > 0)
    <div class="bg-gray-800/50 border border-gray-700 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-700/30 border-b border-gray-600">
                    <tr>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Order</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Customer</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Items</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Total</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Status</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Payment</th>
                        <th class="px-6 py-4 text-left text-gray-300 font-semibold">Date</th>
                        <th class="px-6 py-4 text-center text-gray-300 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-700/30 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div>
                                <h3 class="font-semibold text-amber-400">#{{ $order->order_number }}</h3>
                                <p class="text-gray-400 text-sm">{{ $order->id }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <h4 class="font-semibold text-gray-100">{{ $order->customer->name }}</h4>
                                <p class="text-gray-400 text-sm">{{ $order->customer->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-100 font-semibold">{{ $order->orderItems->sum('quantity') }}</span>
                                <span class="text-gray-400">items</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-amber-400 font-bold text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{
                                $order->status === 'pending' ? 'bg-yellow-600/20 text-yellow-400 border border-yellow-600/30' :
                                ($order->status === 'processing' ? 'bg-blue-600/20 text-blue-400 border border-blue-600/30' :
                                ($order->status === 'shipped' ? 'bg-purple-600/20 text-purple-400 border border-purple-600/30' :
                                ($order->status === 'delivered' ? 'bg-green-600/20 text-green-400 border border-green-600/30' :
                                ($order->status === 'cancelled' ? 'bg-red-600/20 text-red-400 border border-red-600/30' : ''))))
                            }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-300 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-gray-100 font-medium">{{ $order->created_at->format('M j, Y') }}</p>
                                <p class="text-gray-400 text-sm">{{ $order->created_at->format('g:i A') }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.orders.show', $order) }}" 
                                   class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-500 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.orders.edit', $order) }}" 
                                   class="bg-amber-600 text-black p-2 rounded-lg hover:bg-amber-500 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
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
        {{ $orders->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="text-8xl mb-6">📦</div>
        <h3 class="text-3xl font-semibold text-gray-300 mb-4">No Orders Found</h3>
        <p class="text-gray-400 text-lg mb-8">Try adjusting your search criteria or wait for new orders.</p>
        <a href="{{ route('admin.orders.index') }}" 
           class="bg-amber-600 text-black px-8 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold inline-block transform hover:scale-105">
            View All Orders
        </a>
    </div>
    @endif
</div>
@endsection 