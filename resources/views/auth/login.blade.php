@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-amber-400 font-serif">Sign in to your account</h2>
            <p class="mt-2 text-gray-400">Welcome back! Please login to continue.</p>
        </div>
        <form class="mt-8 space-y-6 bg-gray-800/50 border border-gray-700 rounded-2xl p-8 shadow-lg" method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                <input id="email" name="email" type="email" autocomplete="username" required autofocus value="{{ old('email') }}"
                    class="appearance-none rounded-lg relative block w-full px-4 py-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('email')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="appearance-none rounded-lg relative block w-full px-4 py-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('password')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="rounded border-gray-600 text-amber-600 focus:ring-amber-500">
                    <span class="ml-2 text-sm text-gray-400">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-amber-400 hover:text-amber-300">Forgot password?</a>
                @endif
            </div>
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-semibold rounded-xl text-black bg-amber-600 hover:bg-amber-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all">Sign In</button>
            </div>
            <div class="text-center mt-4">
                <span class="text-gray-400">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-amber-400 hover:text-amber-300 font-semibold ml-1">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
