@extends('layouts.app')

@section('title', 'HR Dashboard')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Welcome Banner for HR -->
        <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl p-6 text-white mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}! 💼</h2>
                    <p class="opacity-90">Human Resources Panel - Staff & Access Management</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-user-tie text-6xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- HR Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Staff -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Staff</p>
                        <p class="text-3xl font-bold text-pink-600 mt-2">3</p>
                    </div>
                    <div class="bg-pink-50 p-3 rounded-lg">
                        <i class="fas fa-users text-pink-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-building text-pink-500 mr-1"></i>
                    <span>Registered employees</span>
                </div>
            </div>

            <!-- Active Staff -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Today</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">1</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <i class="fas fa-user-check text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-clock text-green-500 mr-1"></i>
                    <span>Currently active</span>
                </div>
            </div>

            <!-- Key Requests -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Key Requests</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">0</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-key text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-inbox text-blue-500 mr-1"></i>
                    <span>Pending approval</span>
                </div>
            </div>

            <!-- Access Cards -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Access Cards</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2">3</p>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-lg">
                        <i class="fas fa-id-card text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-credit-card text-purple-500 mr-1"></i>
                    <span>Issued cards</span>
                </div>
            </div>
        </div>

        <!-- HR Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <a href="/hr/staff" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-pink-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-users text-pink-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Staff Management</h3>
                <p class="text-sm text-gray-600">Manage employee records</p>
            </a>

            <a href="/hr/requests" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-blue-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-clipboard-check text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Access Requests</h3>
                <p class="text-sm text-gray-600">Approve key assignments</p>
            </a>

            <a href="/hr/reports" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-green-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-chart-bar text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">HR Reports</h3>
                <p class="text-sm text-gray-600">Access usage analytics</p>
            </a>
        </div>

        <!-- Staff Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Staff Activity</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-pink-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">System Administrator</p>
                            <p class="text-sm text-gray-600">Logged into system</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">Just now</span>
                </div>
                <div class="text-center py-4 text-gray-500">
                    <i class="fas fa-history text-2xl mb-2 opacity-50"></i>
                    <p>No recent key activities</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
