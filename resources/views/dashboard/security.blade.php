@extends('layouts.app')

@section('title', 'Security Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner for Security -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}! 🛡️</h2>
                <p class="opacity-90">Security Control Panel - Manage key operations and shifts</p>
                @if($currentShift)
                <div class="mt-3 flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="font-medium">On Duty - Shift active for {{ $stats['current_shift_duration'] }} minutes</span>
                </div>
                @endif
            </div>
            <div class="hidden md:block">
                <i class="fas fa-shield-alt text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Shift Management -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Shift Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Shift Status</h3>
                @if($currentShift)
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                    Active
                </span>
                @else
                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                    Off Duty
                </span>
                @endif
            </div>
            
            @if($currentShift)
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Started</span>
                    <span class="font-medium">{{ $currentShift->start_at->format('g:i A') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Duration</span>
                    <span class="font-medium">{{ $stats['current_shift_duration'] }} minutes</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Keys Processed</span>
                    <span class="font-medium">{{ $stats['shift_checkouts'] }}</span>
                </div>
                <form action="{{ route('profile.end-shift') }}" method="POST" class="pt-3 border-t border-gray-200">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition-colors font-medium">
                        <i class="fas fa-stop-circle mr-2"></i>End Shift
                    </button>
                </form>
            </div>
            @else
            <div class="text-center py-4">
                <i class="fas fa-clock text-4xl text-gray-400 mb-3"></i>
                <p class="text-gray-600 mb-4">You are currently off duty</p>
                <form action="{{ route('profile.start-shift') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors font-medium">
                        <i class="fas fa-play-circle mr-2"></i>Start Shift
                    </button>
                </form>
            </div>
            @endif
        </div>

        <!-- Today"s Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Today"s Activity</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <i class="fas fa-arrow-right text-green-600"></i>
                        </div>
                        <span class="text-gray-700">Checkouts</span>
                    </div>
                    <span class="text-2xl font-bold text-green-600">{{ $stats['today_checkouts'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fas fa-arrow-left text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Check-ins</span>
                    </div>
                    <span class="text-2xl font-bold text-blue-600">{{ $stats['today_checkins'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <i class="fas fa-key text-purple-600"></i>
                        </div>
                        <span class="text-gray-700">Available Keys</span>
                    </div>
                    <span class="text-2xl font-bold text-purple-600">{{ $stats['available_keys'] }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('kiosk.index') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                    <div class="bg-blue-600 text-white p-2 rounded-lg group-hover:bg-blue-700 transition-colors">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">Key Kiosk</p>
                        <p class="text-sm text-gray-600">Scan QR codes</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-blue-600"></i>
                </a>
                
                <a href="{{ route('keys.index') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors group">
                    <div class="bg-green-600 text-white p-2 rounded-lg group-hover:bg-green-700 transition-colors">
                        <i class="fas fa-key"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">Manage Keys</p>
                        <p class="text-sm text-gray-600">View all keys</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-green-600"></i>
                </a>

                <a href="{{ route('profile.shift-history') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors group">
                    <div class="bg-orange-600 text-white p-2 rounded-lg group-hover:bg-orange-700 transition-colors">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">Shift History</p>
                        <p class="text-sm text-gray-600">View past shifts</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-orange-600"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Available Keys -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Your Recent Activity</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($myRecentActivity as $log)
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                {{ $log->action === 'checkout' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                <i class="fas fa-{{ $log->action === 'checkout' ? 'arrow-right' : 'arrow-left' }} text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $log->key->code }}</p>
                                <p class="text-sm text-gray-600">{{ $log->holder_name }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900 capitalize">{{ $log->action }}</p>
                            <p class="text-xs text-gray-500">{{ $log->created_at->format('g:i A') }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
                    <p>No recent activity</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Available Keys -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Available Keys</h3>
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                    {{ $availableKeys->count() }} keys
                </span>
            </div>
            <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                @forelse($availableKeys as $key)
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">{{ $key->code }}</p>
                            <p class="text-sm text-gray-600">{{ $key->label }}</p>
                            @if($key->location)
                            <p class="text-xs text-gray-500">{{ $key->location->name }}</p>
                            @endif
                        </div>
                        <a href="{{ route('kiosk.checkout', $key) }}" class="bg-green-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-green-700 transition-colors">
                            Checkout
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-key text-3xl mb-2 opacity-50"></i>
                    <p>No available keys</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
