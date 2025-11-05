@extends('layouts.app')

@section('title', 'Check In Key')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header -->
    <div class="text-center">
        <div class="bg-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-arrow-left text-white text-2xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Check In Key</h1>
        <p class="text-gray-600 mt-2">Receive returned key</p>
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
                <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                    Checked Out
                </span>
            </div>
        </div>
    </div>

    <!-- Checkin Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Return Details</h3>
        
        <form action="{{ route('kiosk.process-checkin', $key) }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Holder</label>
                <p class="text-gray-900 font-medium">John Doe (Staff ID: 12345)</p>
                <p class="text-sm text-gray-600">Checked out: 2 hours ago</p>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                <textarea 
                    id="notes" 
                    name="notes" 
                    rows="3" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Any notes about the key return..."
                ></textarea>
            </div>

            <!-- Signature and Photo Placeholder -->
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 border-2 border-dashed border-gray-300 rounded-lg">
                    <i class="fas fa-signature text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-600">Digital Signature</p>
                    <p class="text-xs text-gray-400">(Would capture signature here)</p>
                </div>
                <div class="text-center p-4 border-2 border-dashed border-gray-300 rounded-lg">
                    <i class="fas fa-camera text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-600">Photo Evidence</p>
                    <p class="text-xs text-gray-400">(Would capture photo here)</p>
                </div>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('kiosk.index') }}" class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-lg text-center hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Check In Key
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
