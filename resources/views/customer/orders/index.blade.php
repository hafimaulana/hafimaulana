@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-amber-400 mb-2 font-serif">My Orders</h1>
            <p class="text-gray-400">View your order history and track your purchases</p>
        </div>

        @if(count($orders) > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-100">Order #{{ $order->order_number ?? 'N/A' }}</h3>
                                <p class="text-gray-400 text-sm">{{ $order->created_at ?? 'N/A' }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-600/20 text-amber-400">
                                {{ $order->status ?? 'Pending' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-amber-400 font-bold">Rp {{ number_format($order->total_amount ?? 0, 0, ',', '.') }}</span>
                            <a href="{{ route('customer.orders.show', $order) }}" 
                               class="text-amber-400 hover:text-amber-300 text-sm font-medium">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-8xl mb-6">📦</div>
                <h3 class="text-3xl font-semibold text-gray-300 mb-4">No Orders Yet</h3>
                <p class="text-gray-400 text-lg mb-8">Start shopping to see your orders here.</p>
                <a href="{{ route('products.index') }}" 
                   class="bg-amber-600 text-black px-8 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold inline-block">
                    Browse Products
                </a>
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('customer.profile') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-gray-100 rounded-md hover:bg-gray-500 transition-colors">
                Back to Profile
            </a>
        </div>
    </div>
</div>
@endsection 