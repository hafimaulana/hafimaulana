@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">My Profile</h1>
        <p class="text-gray-400 text-lg">Manage your account information and preferences</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Information -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Personal Information -->
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Personal Information</h2>
                
                <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-gray-300 text-sm font-medium mb-2">First Name *</label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('first_name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-gray-300 text-sm font-medium mb-2">Last Name *</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('last_name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-gray-300 text-sm font-medium mb-2">Phone</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('phone')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="address" class="block text-gray-300 text-sm font-medium mb-2">Address</label>
                        <textarea name="address" id="address" rows="3"
                                  class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('address', auth()->user()->address) }}</textarea>
                        @error('address')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="city" class="block text-gray-300 text-sm font-medium mb-2">City</label>
                            <input type="text" name="city" id="city" value="{{ old('city', auth()->user()->city) }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('city')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="postal_code" class="block text-gray-300 text-sm font-medium mb-2">Postal Code</label>
                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', auth()->user()->postal_code) }}"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('postal_code')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-amber-600 text-black px-8 py-3 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold transform hover:scale-105">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password -->
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Change Password</h2>
                
                <form action="{{ route('customer.password.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="current_password" class="block text-gray-300 text-sm font-medium mb-2">Current Password *</label>
                        <input type="password" name="current_password" id="current_password" required
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('current_password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="new_password" class="block text-gray-300 text-sm font-medium mb-2">New Password *</label>
                        <input type="password" name="new_password" id="new_password" required
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        @error('new_password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="new_password_confirmation" class="block text-gray-300 text-sm font-medium mb-2">Confirm New Password *</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-gray-600 text-gray-100 px-8 py-3 rounded-xl hover:bg-gray-500 transition-all duration-300 font-semibold">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Profile Summary -->
        <div class="lg:col-span-1">
            <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6 sticky top-8">
                <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Profile Summary</h2>
                
                <div class="space-y-6">
                    <!-- Account Info -->
                    <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4">
                        <h3 class="font-semibold text-gray-100 mb-3">Account Information</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Member Since:</span>
                                <span class="text-gray-100">{{ auth()->user()->created_at->format('M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Role:</span>
                                <span class="text-amber-400 capitalize">{{ auth()->user()->role->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Status:</span>
                                <span class="text-green-400">Active</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-gray-700/30 border border-gray-600 rounded-xl p-4">
                        <h3 class="font-semibold text-gray-100 mb-3">Order Statistics</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Total Orders:</span>
                                <span class="text-amber-400 font-semibold">{{ $totalOrders }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Total Spent:</span>
                                <span class="text-amber-400 font-semibold">Rp {{ number_format($totalSpent, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Last Order:</span>
                                <span class="text-gray-100">{{ $lastOrderDate ? $lastOrderDate->format('M j, Y') : 'Never' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-3">
                        <a href="{{ route('customer.orders.index') }}" 
                           class="w-full bg-amber-600 text-black px-6 py-3 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold text-center block">
                            View My Orders
                        </a>
                        <a href="{{ route('products.index') }}" 
                           class="w-full bg-gray-600 text-gray-100 px-6 py-3 rounded-lg hover:bg-gray-500 transition-colors duration-200 font-medium text-center block">
                            Browse Products
                        </a>
                    </div>

                    <!-- Account Actions -->
                    <div class="border-t border-gray-600 pt-6">
                        <h3 class="font-semibold text-gray-100 mb-3">Account Actions</h3>
                        <div class="space-y-3">
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-500 transition-colors duration-200 font-medium text-center">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 