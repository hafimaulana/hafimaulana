@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('customer.orders.index') }}" 
           class="text-amber-400 hover:text-amber-300 transition-colors duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Orders
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Order Details</h1>
        <p class="text-gray-400 text-lg">Order #{{ $order->order_number }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Information -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Order Status -->
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Order Status</h2>
                
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-100 mb-2">Order #{{ $order->order_number }}</h3>
                        <p class="text-gray-400">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                    <span class="px-6 py-3 rounded-full text-lg font-semibold {{
                        $order->status === 'pending' ? 'bg-yellow-600/20 text-yellow-400 border border-yellow-600/30' :
                        ($order->status === 'processing' ? 'bg-blue-600/20 text-blue-400 border border-blue-600/30' :
                        ($order->status === 'shipped' ? 'bg-purple-600/20 text-purple-400 border border-purple-600/30' :
                        ($order->status === 'delivered' ? 'bg-green-600/20 text-green-400 border border-green-600/30' :
                        ($order->status === 'cancelled' ? 'bg-red-600/20 text-red-400 border border-red-600/30' : ''))))
                    }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <!-- Status Timeline -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-100">Order Placed</p>
                            <p class="text-gray-400 text-sm">{{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>

                    @if($order->status !== 'pending' && $order->status !== 'cancelled')
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-100">Processing</p>
                            <p class="text-gray-400 text-sm">Your order is being prepared</p>
                        </div>
                    </div>
                    @endif

                    @if(in_array($order->status, ['shipped', 'delivered']))
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-100">Shipped</p>
                            <p class="text-gray-400 text-sm">Your coffee is on the way</p>
                        </div>
                    </div>
                    @endif

                    @if($order->status === 'delivered')
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-100">Delivered</p>
                            <p class="text-gray-400 text-sm">Your coffee has been delivered</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Order Items</h2>
                
                <div class="space-y-6">
                    @foreach($order->orderItems as $item)
                    <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-6">
                        <div class="flex items-center space-x-4">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                                @else
                                <div class="w-20 h-20 bg-gradient-to-br from-gray-600 to-gray-700 rounded-lg flex items-center justify-center">
                                    <span class="text-2xl">☕</span>
                                </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-100 text-lg mb-2">{{ $item->product->name }}</h3>
                                <p class="text-gray-400 text-sm mb-2">{{ $item->product->origin }} • {{ $item->product->roast_level }}</p>
                                <p class="text-gray-300">Quantity: {{ $item->quantity }}</p>
                            </div>

                            <!-- Price -->
                            <div class="text-right">
                                <p class="text-amber-400 font-bold text-xl">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                <p class="text-gray-400 text-sm">per unit</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Shipping Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-gray-100 mb-4">Contact Information</h3>
                        <div class="space-y-2">
                            <p class="text-gray-300">
                                <span class="font-semibold">{{ $order->first_name }} {{ $order->last_name }}</span>
                            </p>
                            <p class="text-gray-300">{{ $order->email }}</p>
                            <p class="text-gray-300">{{ $order->phone }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold text-gray-100 mb-4">Shipping Address</h3>
                        <div class="space-y-2">
                            <p class="text-gray-300">{{ $order->address }}</p>
                            <p class="text-gray-300">{{ $order->city }}, {{ $order->postal_code }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            @if($order->notes)
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Order Notes</h2>
                <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4">
                    <p class="text-gray-300 italic">"{{ $order->notes }}"</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 sticky top-8">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Order Summary</h2>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-gray-300">
                        <span>Items ({{ $order->orderItems->sum('quantity') }}):</span>
                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-300">
                        <span>Shipping:</span>
                        <span class="text-green-400">Free</span>
                    </div>
                    <div class="border-t border-gray-600 pt-4">
                        <div class="flex justify-between text-amber-400 font-bold text-2xl">
                            <span>Total:</span>
                            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4">
                        <h3 class="font-semibold text-gray-100 mb-2">Payment Method</h3>
                        <p class="text-amber-400 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                    </div>

                    @if($order->status === 'pending')
                    <div class="bg-yellow-600/10 border border-yellow-600/30 rounded-xl p-4">
                        <h3 class="font-semibold text-yellow-400 mb-2">Payment Status</h3>
                        <p class="text-yellow-300">Awaiting payment confirmation</p>
                    </div>
                    @elseif($order->status === 'processing')
                    <div class="bg-blue-600/10 border border-blue-600/30 rounded-xl p-4">
                        <h3 class="font-semibold text-blue-400 mb-2">Order Status</h3>
                        <p class="text-blue-300">Your order is being prepared</p>
                    </div>
                    @elseif($order->status === 'shipped')
                    <div class="bg-purple-600/10 border border-purple-600/30 rounded-xl p-4">
                        <h3 class="font-semibold text-purple-400 mb-2">Shipping Status</h3>
                        <p class="text-purple-300">Your coffee is on the way</p>
                    </div>
                    @elseif($order->status === 'delivered')
                    <div class="bg-green-600/10 border border-green-600/30 rounded-xl p-4">
                        <h3 class="font-semibold text-green-400 mb-2">Delivery Status</h3>
                        <p class="text-green-300">Your order has been delivered</p>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 space-y-3">
                    <a href="{{ route('products.index') }}" 
                       class="w-full bg-amber-600 text-black px-6 py-3 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold text-center block">
                        Order Again
                    </a>
                    <a href="{{ route('customer.orders.index') }}" 
                       class="w-full bg-gray-600 text-gray-100 px-6 py-3 rounded-lg hover:bg-gray-500 transition-colors duration-200 font-medium text-center block">
                        View All Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 