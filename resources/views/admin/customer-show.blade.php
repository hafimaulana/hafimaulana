@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Customer Details</h1>
                    <p class="text-gray-600 mt-2">View customer information</p>
                </div>
                <a href="{{ route('admin.customers') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                    Back to Customers
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Customer Information</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 h-16 w-16">
                                <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-2xl font-medium text-gray-700">
                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $customer->name }}</h3>
                                <p class="text-gray-600">{{ $customer->email }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $customer->name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $customer->email }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 mt-1">
                                    {{ $customer->role->name }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Registered Date</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $customer->created_at->format('F d, Y \a\t g:i A') }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $customer->updated_at->format('F d, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Account Statistics</h4>
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-gray-900">{{ $customer->created_at->diffForHumans() }}</div>
                                <p class="text-sm text-gray-600">Member since</p>
                            </div>

                            <div class="bg-blue-50 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-blue-900">{{ $customer->id }}</div>
                                <p class="text-sm text-blue-600">Customer ID</p>
                            </div>

                            <div class="bg-green-50 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-green-900">Active</div>
                                <p class="text-sm text-green-600">Account Status</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($customer->id !== auth()->id())
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Danger Zone</h4>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h5 class="text-sm font-medium text-red-800">Delete Customer Account</h5>
                                <p class="text-sm text-red-600 mt-1">This action cannot be undone. This will permanently delete the customer account.</p>
                            </div>
                            <form action="{{ route('admin.customers.destroy', $customer) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this customer? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-sm">
                                    Delete Customer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 