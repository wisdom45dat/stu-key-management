@extends('layouts.app')

@section('title', 'Check Out Key')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header -->
    <div class="text-center">
        <div class="bg-green-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-arrow-right text-white text-2xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Check Out Key</h1>
        <p class="text-gray-600 mt-2">Issue key to staff member</p>
    </div>

    <!-- Key Information -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Key Details</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Key Code</p>
                <p class="font-medium text-gray-900">{{ $key->code }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Key Label</p>
                <p class="font-medium text-gray-900">{{ $key->label }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Location</p>
                <p class="font-medium text-gray-900">{{ $key->location->name ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Status</p>
                <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                    Available
                </span>
            </div>
        </div>
    </div>

    <!-- Checkout Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Assign to Staff Member</h3>
        
        <!-- Search Staff -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Staff</label>
            <div class="flex space-x-2">
                <input 
                    type="text" 
                    id="staff-search" 
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search by name, ID, or phone..."
                >
                <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Search
                </button>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 gap-4 mb-6">
            <a href="{{ route('kiosk.search-holder') }}" class="bg-blue-600 text-white py-3 rounded-lg text-center hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-2"></i>Browse Staff
            </a>
            <a href="#" class="bg-green-600 text-white py-3 rounded-lg text-center hover:bg-green-700 transition-colors">
                <i class="fas fa-user-plus mr-2"></i>Add Temporary
            </a>
        </div>

        <!-- Manual Form (Fallback) -->
        <form action="{{ route('kiosk.process-checkout', $key) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="holder_name" class="block text-sm font-medium text-gray-700 mb-2">Staff Name</label>
                <input 
                    type="text" 
                    id="holder_name" 
                    name="holder_name" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >
            </div>
            <div>
                <label for="holder_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input 
                    type="tel" 
                    id="holder_phone" 
                    name="holder_phone" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >
            </div>
            <div>
                <label for="expected_return_at" class="block text-sm font-medium text-gray-700 mb-2">Expected Return (Optional)</label>
                <input 
                    type="datetime-local" 
                    id="expected_return_at" 
                    name="expected_return_at" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('kiosk.index') }}" class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-lg text-center hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="flex-1 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition-colors font-medium">
                    Check Out Key
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
