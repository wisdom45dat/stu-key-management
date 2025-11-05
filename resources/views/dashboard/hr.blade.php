@extends('layouts.app')

@section('title', 'HR Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner for HR -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}! 👥</h2>
                <p class="opacity-90">HR Management Panel - Staff management and key oversight</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-users text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- HR Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Staff -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Staff</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['total_staff'] }}</p>
                </div>
                <div class="bg-purple-50 p-3 rounded-lg">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <i class="fas fa-user-check text-green-500 mr-1"></i>
                <span>{{ $stats['active_staff'] }} active</span>
            </div>
        </div>

        <!-- Staff with Keys -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Staff with Keys</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['staff_with_keys'] }}</p>
                </div>
                <div class="bg-blue-50 p-3 rounded-lg">
                    <i class="fas fa-key text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <i class="fas fa-clock text-orange-500 mr-1"></i>
                <span>Currently holding keys</span>
            </div>
        </div>

        <!-- Pending Discrepancies -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Issues</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['pending_discrepancies'] }}</p>
                </div>
                <div class="bg-red-50 p-3 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <i class="fas fa-clock text-red-500 mr-1"></i>
                <span>Require attention</span>
            </div>
        </div>

        <!-- Departments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Departments</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['departments'] }}</p>
                </div>
                <div class="bg-green-50 p-3 rounded-lg">
                    <i class="fas fa-building text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <i class="fas fa-sitemap text-green-500 mr-1"></i>
                <span>Active departments</span>
            </div>
        </div>
    </div>

    <!-- Today"s Activity -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Today"s Overview -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Today"s Overview</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <i class="fas fa-arrow-right text-green-600"></i>
                        </div>
                        <span class="text-gray-700">Total Checkouts</span>
                    </div>
                    <span class="text-2xl font-bold text-green-600">{{ $stats['today_checkouts'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fas fa-arrow-left text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Total Check-ins</span>
                    </div>
                    <span class="text-2xl font-bold text-blue-600">{{ $stats['today_checkins'] }}</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <i class="fas fa-exchange-alt text-purple-600"></i>
                        </div>
                        <span class="text-gray-700">Total Transactions</span>
                    </div>
                    <span class="text-2xl font-bold text-purple-600">{{ $stats['total_transactions'] }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('hr.staff.index') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-colors group">
                    <div class="bg-purple-600 text-white p-2 rounded-lg group-hover:bg-purple-700 transition-colors">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">Staff Directory</p>
                        <p class="text-sm text-gray-600">View all staff members</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-purple-600"></i>
                </a>
                
                <a href="{{ route('hr.discrepancies.index') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-red-500 hover:bg-red-50 transition-colors group">
                    <div class="bg-red-600 text-white p-2 rounded-lg group-hover:bg-red-700 transition-colors">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">Discrepancies</p>
                        <p class="text-sm text-gray-600">Resolve key issues</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-red-600"></i>
                </a>

                <a href="{{ route('hr.import.form') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                    <div class="bg-blue-600 text-white p-2 rounded-lg group-hover:bg-blue-700 transition-colors">
                        <i class="fas fa-file-import"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">Import Staff</p>
                        <p class="text-sm text-gray-600">Upload staff data</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-blue-600"></i>
                </a>

                <a href="{{ route('reports.staff-activity') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors group">
                    <div class="bg-green-600 text-white p-2 rounded-lg group-hover:bg-green-700 transition-colors">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-800">Staff Reports</p>
                        <p class="text-sm text-gray-600">Activity analytics</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-green-600"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Staff with Keys & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Staff Currently Holding Keys -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Staff with Keys</h3>
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                    {{ $staffWithKeys->count() }} staff
                </span>
            </div>
            <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                @forelse($staffWithKeys as $staff)
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $staff->name }}</p>
                                <p class="text-sm text-gray-600">{{ $staff->staff_id }}</p>
                                <p class="text-xs text-gray-500">{{ $staff->dept ?? 'No department' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-sm font-medium">
                                {{ $staff->current_keys_count }} keys
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-key text-3xl mb-2 opacity-50"></i>
                    <p>No staff currently holding keys</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Staff Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Recent Staff Activity</h3>
            </div>
            <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                @forelse($recentStaffActivity as $log)
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center 
                                {{ $log->action === 'checkout' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                <i class="fas fa-{{ $log->action === 'checkout' ? 'arrow-right' : 'arrow-left' }} text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $log->holder_name }}</p>
                                <p class="text-sm text-gray-600">{{ $log->key->code }} - {{ $log->key->label }}</p>
                                <p class="text-xs text-gray-500">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded-full 
                                {{ $log->action === 'checkout' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $log->action === 'checkout' ? 'Checkout' : 'Return' }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-history text-3xl mb-2 opacity-50"></i>
                    <p>No recent staff activity</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Department Overview -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Department Overview</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $departments = \App\Models\HrStaff::select('dept')
                        ->selectRaw('COUNT(*) as staff_count')
                        ->whereNotNull('dept')
                        ->groupBy('dept')
                        ->orderBy('staff_count', 'desc')
                        ->limit(8)
                        ->get();
                @endphp
                
                @forelse($departments as $dept)
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <p class="font-medium text-gray-900">{{ $dept->dept }}</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $dept->staff_count }}</p>
                    <p class="text-sm text-gray-600">staff members</p>
                </div>
                @empty
                <div class="col-span-4 text-center py-8 text-gray-500">
                    <i class="fas fa-building text-3xl mb-2 opacity-50"></i>
                    <p>No department data available</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
