@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Welcome Banner for Admin -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-6 text-white mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}! 👑</h2>
                    <p class="opacity-90">Administrator Panel - System Management & Oversight</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-crown text-6xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Admin Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Users -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2">3</p>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-lg">
                        <i class="fas fa-users text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-shield-alt text-purple-500 mr-1"></i>
                    <span>System access</span>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">System Health</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">100%</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <i class="fas fa-heartbeat text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-check-circle text-green-500 mr-1"></i>
                    <span>All systems operational</span>
                </div>
            </div>

            <!-- Total Keys -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Keys</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">0</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-key text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-database text-blue-500 mr-1"></i>
                    <span>In system</span>
                </div>
            </div>

            <!-- Active Sessions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Sessions</p>
                        <p class="text-3xl font-bold text-orange-600 mt-2">1</p>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-lg">
                        <i class="fas fa-user-clock text-orange-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-signal text-orange-500 mr-1"></i>
                    <span>Currently online</span>
                </div>
            </div>
        </div>

        <!-- Admin Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <a href="/admin/users" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-purple-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-user-cog text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">User Management</h3>
                <p class="text-sm text-gray-600">Manage system users & permissions</p>
            </a>

            <a href="/admin/audit" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-blue-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-clipboard-list text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Audit Logs</h3>
                <p class="text-sm text-gray-600">View system activity & reports</p>
            </a>

            <a href="/admin/settings" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-green-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-cogs text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">System Settings</h3>
                <p class="text-sm text-gray-600">Configure system preferences</p>
            </a>
        </div>

        <!-- System Overview -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">System Overview</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-gray-700 mb-3">Recent Activity</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                    <i class="fas fa-user-plus text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">User Login</p>
                                    <p class="text-sm text-gray-600">Admin session started</p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">Just now</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-gray-700 mb-3">Quick Stats</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Database Size</span>
                            <span class="font-medium">2.4 MB</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Last Backup</span>
                            <span class="font-medium">Today</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">System Uptime</span>
                            <span class="font-medium">99.9%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
