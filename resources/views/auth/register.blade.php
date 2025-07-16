@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-amber-400 font-serif">Create your account</h2>
            <p class="mt-2 text-gray-400">Join us and enjoy the best coffee experience!</p>
        </div>
        <form class="mt-8 space-y-6 bg-gray-800/50 border border-gray-700 rounded-2xl p-8 shadow-lg" method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                <input id="name" name="name" type="text" autocomplete="name" required autofocus value="{{ old('name') }}"
                    class="appearance-none rounded-lg relative block w-full px-4 py-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('name')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                <input id="email" name="email" type="email" autocomplete="username" required value="{{ old('email') }}"
                    class="appearance-none rounded-lg relative block w-full px-4 py-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('email')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required
                    class="appearance-none rounded-lg relative block w-full px-4 py-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('password')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                    class="appearance-none rounded-lg relative block w-full px-4 py-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('password_confirmation')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-semibold rounded-xl text-black bg-amber-600 hover:bg-amber-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all">Register</button>
            </div>
            <div class="text-center mt-4">
                <span class="text-gray-400">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-amber-400 hover:text-amber-300 font-semibold ml-1">Sign in</a>
            </div>
        </form>
    </div>
</div>
@endsection
