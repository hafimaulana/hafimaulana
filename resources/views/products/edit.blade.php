@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
            <p class="text-gray-600 mt-2">Update product information</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('description') border-red-500 @enderror" 
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700 mb-2">Origin</label>
                        <input type="text" name="origin" id="origin" value="{{ old('origin', $product->origin) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('origin') border-red-500 @enderror" 
                               required>
                        @error('origin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="roast_level" class="block text-sm font-medium text-gray-700 mb-2">Roast Level</label>
                        <select name="roast_level" id="roast_level" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('roast_level') border-red-500 @enderror" 
                                required>
                            <option value="">Select roast level</option>
                            <option value="Light" {{ old('roast_level', $product->roast_level) == 'Light' ? 'selected' : '' }}>Light</option>
                            <option value="Medium" {{ old('roast_level', $product->roast_level) == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="Medium-Dark" {{ old('roast_level', $product->roast_level) == 'Medium-Dark' ? 'selected' : '' }}>Medium-Dark</option>
                            <option value="Dark" {{ old('roast_level', $product->roast_level) == 'Dark' ? 'selected' : '' }}>Dark</option>
                        </select>
                        @error('roast_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('price') border-red-500 @enderror" 
                               required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('stock') border-red-500 @enderror" 
                               required>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                    @if($product->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Current image:</p>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-md">
                    </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('image') border-red-500 @enderror">
                    <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded-md hover:bg-amber-700">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 