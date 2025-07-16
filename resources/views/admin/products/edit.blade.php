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
        <h1 class="text-4xl font-bold text-amber-400 mb-2 font-serif">Edit Product</h1>
        <p class="text-gray-400 text-lg">Update product information for {{ $product->name }}</p>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-8">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div>
                    <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Basic Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-gray-300 text-sm font-medium mb-2">Product Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="category" class="block text-gray-300 text-sm font-medium mb-2">Category *</label>
                            <select name="category" id="category" required
                                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="">Select Category</option>
                                <option value="Single Origin" {{ old('category', $product->category) == 'Single Origin' ? 'selected' : '' }}>Single Origin</option>
                                <option value="Blend" {{ old('category', $product->category) == 'Blend' ? 'selected' : '' }}>Blend</option>
                                <option value="Espresso" {{ old('category', $product->category) == 'Espresso' ? 'selected' : '' }}>Espresso</option>
                                <option value="Filter" {{ old('category', $product->category) == 'Filter' ? 'selected' : '' }}>Filter</option>
                                <option value="Decaf" {{ old('category', $product->category) == 'Decaf' ? 'selected' : '' }}>Decaf</option>
                            </select>
                            @error('category')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="origin" class="block text-gray-300 text-sm font-medium mb-2">Origin *</label>
                            <input type="text" name="origin" id="origin" value="{{ old('origin', $product->origin) }}" required
                                   placeholder="e.g., Colombia, Ethiopia, Brazil"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('origin')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="roast_level" class="block text-gray-300 text-sm font-medium mb-2">Roast Level *</label>
                            <select name="roast_level" id="roast_level" required
                                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="">Select Roast Level</option>
                                <option value="Light" {{ old('roast_level', $product->roast_level) == 'Light' ? 'selected' : '' }}>Light</option>
                                <option value="Medium" {{ old('roast_level', $product->roast_level) == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Medium-Dark" {{ old('roast_level', $product->roast_level) == 'Medium-Dark' ? 'selected' : '' }}>Medium-Dark</option>
                                <option value="Dark" {{ old('roast_level', $product->roast_level) == 'Dark' ? 'selected' : '' }}>Dark</option>
                                <option value="French" {{ old('roast_level', $product->roast_level) == 'French' ? 'selected' : '' }}>French</option>
                                <option value="Italian" {{ old('roast_level', $product->roast_level) == 'Italian' ? 'selected' : '' }}>Italian</option>
                            </select>
                            @error('roast_level')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing & Stock -->
                <div>
                    <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Pricing & Stock</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price" class="block text-gray-300 text-sm font-medium mb-2">Price (Rp) *</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0" step="1000"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('price')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="stock" class="block text-gray-300 text-sm font-medium mb-2">Stock Quantity *</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            @error('stock')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="is_available" class="block text-gray-300 text-sm font-medium mb-2">Availability</label>
                            <select name="is_available" id="is_available"
                                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="1" {{ old('is_available', $product->is_available) == '1' ? 'selected' : '' }}>Available</option>
                                <option value="0" {{ old('is_available', $product->is_available) == '0' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                            @error('is_available')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Product Description</h2>
                    
                    <div>
                        <label for="description" class="block text-gray-300 text-sm font-medium mb-2">Description *</label>
                        <textarea name="description" id="description" rows="6" required
                                  placeholder="Describe the coffee's flavor profile, aroma, and characteristics..."
                                  class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Product Image -->
                <div>
                    <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Product Image</h2>
                    
                    <!-- Current Image -->
                    @if($product->image)
                    <div class="mb-6">
                        <label class="block text-gray-300 text-sm font-medium mb-2">Current Image</label>
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-24 h-24 object-cover rounded-lg border border-gray-600">
                            <div>
                                <p class="text-gray-400 text-sm">Current product image</p>
                                <p class="text-gray-500 text-xs">Upload a new image to replace this one</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div>
                        <label for="image" class="block text-gray-300 text-sm font-medium mb-2">New Product Image (Optional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600 border-dashed rounded-lg hover:border-amber-500 transition-colors duration-200">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-400">
                                    <label for="image" class="relative cursor-pointer bg-gray-700 rounded-md font-medium text-amber-400 hover:text-amber-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-amber-500">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                        @error('image')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Information -->
                <div>
                    <h2 class="text-2xl font-semibold text-amber-400 mb-6 font-serif">Additional Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="processing_method" class="block text-gray-300 text-sm font-medium mb-2">Processing Method</label>
                            <select name="processing_method" id="processing_method"
                                    class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="">Select Processing Method</option>
                                <option value="Washed" {{ old('processing_method', $product->processing_method) == 'Washed' ? 'selected' : '' }}>Washed</option>
                                <option value="Natural" {{ old('processing_method', $product->processing_method) == 'Natural' ? 'selected' : '' }}>Natural</option>
                                <option value="Honey" {{ old('processing_method', $product->processing_method) == 'Honey' ? 'selected' : '' }}>Honey</option>
                                <option value="Anaerobic" {{ old('processing_method', $product->processing_method) == 'Anaerobic' ? 'selected' : '' }}>Anaerobic</option>
                                <option value="Mixed" {{ old('processing_method', $product->processing_method) == 'Mixed' ? 'selected' : '' }}>Mixed</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="altitude" class="block text-gray-300 text-sm font-medium mb-2">Altitude (masl)</label>
                            <input type="text" name="altitude" id="altitude" value="{{ old('altitude', $product->altitude) }}"
                                   placeholder="e.g., 1200-1500"
                                   class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-600">
                    <a href="{{ route('admin.products.index') }}" 
                       class="bg-gray-600 text-gray-100 px-8 py-3 rounded-xl hover:bg-gray-500 transition-colors duration-200 font-semibold">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-amber-600 text-black px-8 py-3 rounded-xl hover:bg-amber-500 transition-all duration-300 font-semibold transform hover:scale-105">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 