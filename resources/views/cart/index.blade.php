@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Shopping Cart</h1>
        <p class="text-gray-400 text-lg">Review your selected coffee products</p>
    </div>

    @if($cartItems->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Cart Items</h2>
                
                <div class="space-y-6">
                    @foreach($cartItems as $item)
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
                                <h3 class="font-semibold text-gray-100 text-lg">{{ $item->product->name }}</h3>
                                <p class="text-gray-400 text-sm">{{ $item->product->origin }} • {{ $item->product->roast_level }}</p>
                                <p class="text-amber-400 font-bold text-lg">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>

                            <!-- Quantity Controls -->
                            <div class="flex items-center space-x-3">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="decrease" 
                                            class="w-8 h-8 bg-gray-600 text-gray-100 rounded-lg hover:bg-gray-500 transition-colors flex items-center justify-center {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    
                                    <span class="text-gray-100 font-semibold min-w-[2rem] text-center">{{ $item->quantity }}</span>
                                    
                                    <button type="submit" name="action" value="increase" 
                                            class="w-8 h-8 bg-gray-600 text-gray-100 rounded-lg hover:bg-gray-500 transition-colors flex items-center justify-center {{ $item->quantity >= $item->product->stock ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </button>
                                </form>

                                <!-- Remove Button -->
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-8 h-8 bg-red-600 text-white rounded-lg hover:bg-red-500 transition-colors flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Subtotal -->
                        <div class="mt-4 pt-4 border-t border-gray-600 flex justify-between items-center">
                            <span class="text-gray-400">Subtotal:</span>
                            <span class="text-amber-400 font-bold text-lg">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Clear Cart Button -->
                <div class="mt-6 pt-6 border-t border-gray-600">
                    <form action="{{ route('cart.clear') }}" method="POST" class="text-center">
                        @csrf
                        <button type="submit" 
                                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-500 transition-colors duration-200 font-medium">
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 sticky top-8">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Order Summary</h2>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-gray-300">
                        <span>Items ({{ $cartItems->sum('quantity') }}):</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-300">
                        <span>Shipping:</span>
                        <span class="text-green-400">Free</span>
                    </div>
                    <div class="border-t border-gray-600 pt-4">
                        <div class="flex justify-between text-amber-400 font-bold text-xl">
                            <span>Total:</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Checkout Button -->
                <a href="{{ route('checkout.index') }}" 
                   class="w-full bg-amber-600 text-black px-6 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold text-lg text-center block transform hover:scale-105">
                    Proceed to Checkout
                </a>

                <!-- Continue Shopping -->
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" 
                       class="w-full bg-gray-600 text-gray-100 px-6 py-3 rounded-lg hover:bg-gray-500 transition-colors duration-200 font-medium text-center block">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart -->
    <div class="text-center py-16">
        <div class="text-8xl mb-6">☕</div>
        <h3 class="text-3xl font-semibold text-gray-300 mb-4">Your Cart is Empty</h3>
        <p class="text-gray-400 text-lg mb-8">Looks like you haven't added any coffee products to your cart yet.</p>
        <a href="{{ route('products.index') }}" 
           class="bg-amber-600 text-black px-8 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold inline-block transform hover:scale-105">
            Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection 