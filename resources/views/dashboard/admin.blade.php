@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h2>
                <p class="opacity-90">Here's what's happening with your key management system today.</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-key text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Keys -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Keys</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Key::count() }}</p>
                </div>
                <div class="bg-blue-50 p-3 rounded-lg">
                    <i class="fas fa-key text-primary text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <i class="fas fa-arrow-up text-success mr-1"></i>
                <span>All system keys</span>
            </div>
        </div>

        <!-- Available Keys -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Available Keys</p>
                    <p class="text-3xl font-bold text-success mt-2">{{ \App\Models\Key::where('status', 'available')->count() }}</p>
                </div>
                <div class="bg-green-50 p-3 rounded-lg">
                    <i class="fas fa-unlock text-success text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <i class="fas fa-check-circle text-success mr-1"></i>
                <span>Ready for checkout</span>
            </div>
        </div>

        <!-- Checked Out Keys -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Checked Out</p>
                    <p class="text-3xl font-bold text-warning mt-2">{{ \App\Models\Key::where('status', 'checked_out')->count() }}</p>
                </div>
                <div class="bg-yellow-50 p-3 rounded-lg">
                    <i class="fas fa-lock text-warning text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <i class="fas fa-users text-warning mr-1"></i>
                <span>Currently with staff</span>
            </div>
        </div>

        <!-- Active Staff -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Staff</p>
                    <p class="text-3xl font-bold text-primary mt-2">{{ \App\Models\HrStaff::where('status', 'active')->count() }}</p>
                </div>
                <div class="bg-purple-50 p-3 rounded-lg">
                    <i class="fas fa-users text-primary text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <i class="fas fa-user-check text-primary mr-1"></i>
                <span>Registered staff members</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                @can('access kiosk')
                <a href="{{ route('kiosk.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-blue-50 transition-colors group">
                    <div class="bg-primary text-white p-3 rounded-lg group-hover:bg-secondary transition-colors">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium text-gray-800">Key Kiosk</p>
                        <p class="text-sm text-gray-600">Check in/out keys using QR codes</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-primary"></i>
                </a>
                @endcan

                <a href="{{ route('keys.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-blue-50 transition-colors group">
                    <div class="bg-success text-white p-3 rounded-lg group-hover:bg-green-600 transition-colors">
                        <i class="fas fa-key"></i>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium text-gray-800">Manage Keys</p>
                        <p class="text-sm text-gray-600">View and manage all keys</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-primary"></i>
                </a>

                @canany(['admin', 'hr'])
                <a href="{{ route('hr.dashboard') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-primary hover:bg-blue-50 transition-colors group">
                    <div class="bg-warning text-white p-3 rounded-lg group-hover:bg-orange-500 transition-colors">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium text-gray-800">HR Management</p>
                        <p class="text-sm text-gray-600">Manage staff and discrepancies</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-primary"></i>
                </a>
                @endcanany
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                <a href="#" class="text-primary text-sm font-medium hover:text-secondary">View All</a>
            </div>
            <div class="space-y-4">
                @php
                    $recentLogs = \App\Models\KeyLog::with(['key', 'receiver'])->latest()->limit(5)->get();
                @endphp
                
                @forelse($recentLogs as $log)
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center 
                            {{ $log->action === 'checkout' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                            <i class="fas fa-{{ $log->action === 'checkout' ? 'arrow-right' : 'arrow-left' }}"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $log->key->code }} - {{ $log->key->label }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{ $log->action === 'checkout' ? 'Checked out by' : 'Returned by' }} 
                            {{ $log->holder_name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $log->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                    <p>No recent activity</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
