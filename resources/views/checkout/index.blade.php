@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Checkout</h1>
        <p class="text-gray-400 text-lg">Complete your coffee order</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Shipping Information -->
                <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                    <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Shipping Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-gray-300 text-sm font-medium mb-2">First Name *</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', auth()->user()->first_name ?? '') }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('first_name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-gray-300 text-sm font-medium mb-2">Last Name *</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', auth()->user()->last_name ?? '') }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('last_name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-gray-300 text-sm font-medium mb-2">Phone *</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('phone')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="address" class="block text-gray-300 text-sm font-medium mb-2">Address *</label>
                            <textarea name="address" id="address" rows="3" required
                                      class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('address') }}</textarea>
                            @error('address')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="city" class="block text-gray-300 text-sm font-medium mb-2">City *</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('city')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="postal_code" class="block text-gray-300 text-sm font-medium mb-2">Postal Code *</label>
                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('postal_code')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                    <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Payment Information</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="payment_method" class="block text-gray-300 text-sm font-medium mb-2">Payment Method *</label>
                            <select name="payment_method" id="payment_method" required
                                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="">Select Payment Method</option>
                                <option value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                            @error('payment_method')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="notes" class="block text-gray-300 text-sm font-medium mb-2">Order Notes</label>
                            <textarea name="notes" id="notes" rows="3" placeholder="Any special instructions for your order..."
                                      class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('notes') }}</textarea>
                            @error('notes')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 sticky top-8">
                    <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Order Summary</h2>
                    
                    <!-- Order Items -->
                    <div class="space-y-4 mb-6">
                        @foreach($cartItems as $item)
                        <div class="flex justify-between items-center">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-100">{{ $item->product->name }}</h4>
                                <p class="text-gray-400 text-sm">Qty: {{ $item->quantity }}</p>
                            </div>
                            <span class="text-amber-400 font-semibold">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Totals -->
                    <div class="border-t border-gray-600 pt-4 space-y-3">
                        <div class="flex justify-between text-gray-300">
                            <span>Subtotal:</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-300">
                            <span>Shipping:</span>
                            <span class="text-green-400">Free</span>
                        </div>
                        <div class="border-t border-gray-600 pt-3">
                            <div class="flex justify-between text-amber-400 font-bold text-xl">
                                <span>Total:</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Place Order Button -->
                    <button type="submit" 
                            class="w-full bg-amber-600 text-black px-6 py-4 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold text-lg mt-6 transform hover:scale-105">
                        Place Order
                    </button>

                    <!-- Back to Cart -->
                    <div class="mt-4">
                        <a href="{{ route('cart.index') }}" 
                           class="w-full bg-gray-600 text-gray-100 px-6 py-3 rounded-lg hover:bg-gray-500 transition-colors duration-200 font-medium text-center block">
                            Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection 