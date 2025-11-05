@extends('layouts.app')

@section('title', 'Shift History')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Shift History</h1>
            <p class="text-gray-600">Your security shift records and history</p>
        </div>
        <div class="flex items-center space-x-4">
            @if(auth()->user()->isOnShift())
            <form action="{{ route('profile.end-shift') }}" method="POST">
                @csrf
                <button type="submit" class="bg-danger text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                    <i class="fas fa-stop-circle mr-2"></i>End Shift
                </button>
            </form>
            @else
            <form action="{{ route('profile.start-shift') }}" method="POST">
                @csrf
                <button type="submit" class="bg-success text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                    <i class="fas fa-play-circle mr-2"></i>Start Shift
                </button>
            </form>
            @endif
            <a href="{{ route('profile.show') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>
    </div>

    <!-- Current Shift Status -->
    @if(auth()->user()->isOnShift())
    <div class="bg-green-50 border border-green-200 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-green-800">Currently on Shift</h3>
                    <p class="text-green-700">
                        Started: {{ auth()->user()->current_shift->start_at->format('M j, Y g:i A') }}
                        ({{ auth()->user()->current_shift->start_at->diffForHumans() }})
                    </p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold text-green-800">
                    {{ now()->diffInMinutes(auth()->user()->current_shift->start_at) }} min
                </p>
                <p class="text-green-700 text-sm">Duration</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Shift Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-blue-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-calendar text-primary text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ auth()->user()->securityShifts()->count() }}</p>
            <p class="text-gray-600">Total Shifts</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-green-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-check-circle text-success text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ auth()->user()->securityShifts()->completed()->count() }}</p>
            <p class="text-gray-600">Completed</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-yellow-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-key text-warning text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                {{ auth()->user()->securityShifts()->withCount('keyLogs')->get()->sum('key_logs_count') }}
            </p>
            <p class="text-gray-600">Keys Processed</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-purple-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-clock text-purple-600 text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                {{ round(auth()->user()->securityShifts()->completed()->get()->avg('duration_in_minutes') ?? 0) }} min
            </p>
            <p class="text-gray-600">Avg. Duration</p>
        </div>
    </div>

    <!-- Shift History -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Shift History</h2>
        </div>
        
        <div class="divide-y divide-gray-200">
            @php
                $shifts = auth()->user()->securityShifts()->latest()->paginate(15);
            @endphp
            
            @forelse($shifts as $shift)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center 
                                {{ $shift->end_at ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                <i class="fas fa-{{ $shift->end_at ? 'check' : 'clock' }}"></i>
                            </div>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">
                                {{ $shift->start_at->format('M j, Y') }}
                            </p>
                            <p class="text-sm text-gray-600 mt-1">
                                <span class="font-medium">{{ $shift->start_at->format('g:i A') }}</span> 
                                to 
                                <span class="font-medium">
                                    {{ $shift->end_at ? $shift->end_at->format('g:i A') : 'Present' }}
                                </span>
                            </p>
                            @if($shift->notes)
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-sticky-note mr-1"></i>{{ Str::limit($shift->notes, 50) }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-800">
                            {{ $shift->end_at ? $shift->getDurationInMinutes() : now()->diffInMinutes($shift->start_at) }} min
                        </p>
                        <span class="inline-block px-2 py-1 text-xs font-medium rounded-full 
                            {{ $shift->end_at ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $shift->end_at ? 'Completed' : 'Active' }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center text-gray-500">
                <i class="fas fa-calendar-times text-4xl mb-3 opacity-50"></i>
                <p class="text-lg">No shift records found</p>
                <p class="text-sm">Your security shifts will appear here</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($shifts->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $shifts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
