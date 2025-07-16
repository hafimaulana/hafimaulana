@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Reports Dashboard</h1>
            <p class="mt-2 text-gray-600">View analytics and reports for your coffee shop</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Reports Coming Soon</h3>
            <p class="text-gray-600">This feature is under development.</p>
        </div>

        <div class="mt-8">
            <a href="{{ route('admin.dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection 