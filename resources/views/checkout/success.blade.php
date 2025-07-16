@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        <!-- Success Icon -->
        <div class="mb-8">
            <div class="w-24 h-24 bg-green-600/20 border-4 border-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <!-- Success Message -->
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-8 mb-8">
            <h1 class="text-4xl font-bold text-amber-400 mb-4 font-serif">Order Confirmed!</h1>
            <p class="text-gray-300 text-lg mb-6">Thank you for your coffee order. Your order has been successfully placed.</p>
            
            <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-6 mb-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-4 font-serif">Order Details</h2>
                <div class="space-y-3 text-left">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Order Number:</span>
                        <span class="text-gray-100 font-semibold">#{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Order Date:</span>
                        <span class="text-gray-100">{{ $order->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Total Amount:</span>
                        <span class="text-amber-400 font-bold text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Payment Method:</span>
                        <span class="text-gray-100 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <span class="px-3 py-1 bg-yellow-600/20 text-yellow-400 rounded-full text-sm font-semibold">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-6 mb-6">
                <h3 class="text-xl font-semibold text-amber-400 mb-4 font-serif">Order Items</h3>
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-12 h-12 object-cover rounded-lg">
                            @else
                            <div class="w-12 h-12 bg-gradient-to-br from-gray-600 to-gray-700 rounded-lg flex items-center justify-center">
                                <span class="text-lg">☕</span>
                            </div>
                            @endif
                            <div>
                                <h4 class="font-semibold text-gray-100">{{ $item->product->name }}</h4>
                                <p class="text-gray-400 text-sm">{{ $item->product->origin }} • {{ $item->product->roast_level }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-300">Qty: {{ $item->quantity }}</p>
                            <p class="text-amber-400 font-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-6 mb-8">
                <h3 class="text-xl font-semibold text-amber-400 mb-4 font-serif">Shipping Information</h3>
                <div class="text-left space-y-2">
                    <p class="text-gray-300">
                        <span class="font-semibold">{{ $order->first_name }} {{ $order->last_name }}</span>
                    </p>
                    <p class="text-gray-300">{{ $order->address }}</p>
                    <p class="text-gray-300">{{ $order->city }}, {{ $order->postal_code }}</p>
                    <p class="text-gray-300">{{ $order->email }}</p>
                    <p class="text-gray-300">{{ $order->phone }}</p>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-amber-600/10 border border-amber-600/30 rounded-xl p-6 mb-8">
                <h3 class="text-xl font-semibold text-amber-400 mb-4 font-serif">What's Next?</h3>
                <div class="space-y-3 text-left">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-amber-600 text-black rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-bold">1</span>
                        </div>
                        <div>
                            <p class="text-gray-300 font-semibold">Order Confirmation</p>
                            <p class="text-gray-400 text-sm">You'll receive an email confirmation with your order details.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-amber-600 text-black rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-bold">2</span>
                        </div>
                        <div>
                            <p class="text-gray-300 font-semibold">Order Processing</p>
                            <p class="text-gray-400 text-sm">We'll prepare your coffee order and update you on the status.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-amber-600 text-black rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <span class="text-xs font-bold">3</span>
                        </div>
                        <div>
                            <p class="text-gray-300 font-semibold">Delivery</p>
                            <p class="text-gray-400 text-sm">Your coffee will be delivered to your address within 2-3 business days.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('customer.orders.show', $order) }}" 
               class="bg-amber-600 text-black px-8 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold transform hover:scale-105">
                View Order Details
            </a>
            <a href="{{ route('products.index') }}" 
               class="bg-gray-600 text-gray-100 px-8 py-4 rounded-xl hover:bg-gray-500 transition-all duration-300 font-semibold">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection 