@extends('layouts.app')

@section('title', 'Security Dashboard')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Welcome Banner for Security -->
        <div class="bg-gradient-to-r from-blue-600 to-green-600 rounded-2xl p-6 text-white mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Welcome, {{ auth()->user()->name }}! 🛡️</h2>
                    <p class="opacity-90">Security Panel - Key management and access control</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-shield-alt text-6xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Security Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Today's Checkouts -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Today's Checkouts</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">0</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <i class="fas fa-arrow-right text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-user text-blue-500 mr-1"></i>
                    <span>By you today</span>
                </div>
            </div>

            <!-- Today's Checkins -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Today's Checkins</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">0</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-arrow-left text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-user text-blue-500 mr-1"></i>
                    <span>By you today</span>
                </div>
            </div>

            <!-- Available Keys -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Available Keys</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2">0</p>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-lg">
                        <i class="fas fa-key text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-check-circle text-green-500 mr-1"></i>
                    <span>Ready for checkout</span>
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Users</p>
                        <p class="text-3xl font-bold text-orange-600 mt-2">1</p>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-lg">
                        <i class="fas fa-users text-orange-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600">
                    <i class="fas fa-user-check text-orange-500 mr-1"></i>
                    <span>Currently online</span>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <a href="/kiosk/checkout" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-green-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-arrow-right text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Checkout Keys</h3>
                <p class="text-sm text-gray-600">Issue keys to users</p>
            </a>

            <a href="/kiosk/checkin" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-blue-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-arrow-left text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Checkin Keys</h3>
                <p class="text-sm text-gray-600">Accept key returns</p>
            </a>

            <a href="/kiosk/scan" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow text-center">
                <div class="bg-purple-100 p-3 rounded-lg inline-block mb-4">
                    <i class="fas fa-qrcode text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">QR Scanner</h3>
                <p class="text-sm text-gray-600">Scan key codes</p>
            </a>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">System Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center p-4 border border-gray-200 rounded-lg">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Authentication</p>
                        <p class="text-sm text-gray-600">System operational</p>
                    </div>
                </div>
                
                <div class="flex items-center p-4 border border-gray-200 rounded-lg">
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4">
                        <i class="fas fa-database"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Database</p>
                        <p class="text-sm text-gray-600">Connected</p>
                    </div>
                </div>
                
                <div class="flex items-center p-4 border border-gray-200 rounded-lg">
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-4">
                        <i class="fas fa-key"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Key System</p>
                        <p class="text-sm text-gray-600">Ready</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
