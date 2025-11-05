@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Activity Log</h1>
            <p class="text-gray-600">Your key management activity history</p>
        </div>
        <a href="{{ route('profile.show') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Back to Profile
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-green-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-arrow-right text-success text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                {{ auth()->user()->keyLogsAsReceiver()->where('action', 'checkout')->count() }}
            </p>
            <p class="text-gray-600">Checkouts</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-blue-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-arrow-left text-primary text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                {{ auth()->user()->keyLogsAsReceiver()->where('action', 'checkin')->count() }}
            </p>
            <p class="text-gray-600">Check-ins</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-purple-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-users text-purple-600 text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                {{ auth()->user()->keyLogsAsReceiver()->distinct('holder_id')->count('holder_id') }}
            </p>
            <p class="text-gray-600">Unique Staff</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-yellow-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-key text-warning text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                {{ auth()->user()->keyLogsAsReceiver()->distinct('key_id')->count('key_id') }}
            </p>
            <p class="text-gray-600">Unique Keys</p>
        </div>
    </div>

    <!-- Activity List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
        </div>
        
        <div class="divide-y divide-gray-200">
            @php
                $activities = auth()->user()->keyLogsAsReceiver()->with(['key', 'key.location'])->latest()->paginate(20);
            @endphp
            
            @forelse($activities as $log)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-start justify-between">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center 
                                {{ $log->action === 'checkout' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                <i class="fas fa-{{ $log->action === 'checkout' ? 'arrow-right' : 'arrow-left' }}"></i>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">
                                {{ $log->key->code }} - {{ $log->key->label }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                <span class="font-medium">{{ $log->action === 'checkout' ? 'Checked out' : 'Returned' }}</span> 
                                to <span class="font-medium">{{ $log->holder_name }}</span>
                                @if($log->key->location)
                                from <span class="font-medium">{{ $log->key->location->name }}</span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-clock mr-1"></i>{{ $log->created_at->format('M j, Y g:i A') }}
                                ({{ $log->created_at->diffForHumans() }})
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-2 py-1 text-xs font-medium rounded-full 
                            {{ $log->action === 'checkout' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $log->action === 'checkout' ? 'Checkout' : 'Check-in' }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center text-gray-500">
                <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                <p class="text-lg">No activity records found</p>
                <p class="text-sm">Your key management activity will appear here</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($activities->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $activities->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
