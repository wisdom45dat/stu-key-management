@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
            <p class="text-gray-600">Manage your account settings and preferences</p>
        </div>
        <div class="bg-primary text-white px-4 py-2 rounded-lg">
            <span class="font-medium capitalize">{{ auth()->user()->getRoleNames()->first() }}</span>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center space-x-6">
            <!-- Avatar -->
            <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center text-white text-2xl font-bold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            
            <!-- User Info -->
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
                <p class="text-gray-600">{{ auth()->user()->email }}</p>
                <p class="text-gray-500 text-sm">{{ auth()->user()->phone ?? 'No phone number' }}</p>
                <p class="text-gray-500 text-sm">Member since {{ auth()->user()->created_at->format('M j, Y') }}</p>
            </div>
            
            <!-- Edit Button -->
            <a href="{{ route('profile.edit') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                Edit Profile
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Checkouts -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-blue-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-key text-primary text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ auth()->user()->keyLogsAsReceiver()->count() }}</p>
            <p class="text-gray-600">Total Processed</p>
        </div>

        <!-- Current Shift -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-green-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-clock text-success text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">
                {{ auth()->user()->isOnShift() ? 'Active' : 'Off' }}
            </p>
            <p class="text-gray-600">Current Shift</p>
        </div>

        <!-- Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
            <div class="bg-purple-50 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-chart-line text-primary text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-gray-800">-</p>
            <p class="text-gray-600">This Week</p>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('profile.activity') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:border-primary hover:bg-blue-50 transition-colors group">
            <div class="flex items-center space-x-4">
                <div class="bg-primary text-white p-3 rounded-lg group-hover:bg-secondary transition-colors">
                    <i class="fas fa-history"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Activity Log</h3>
                    <p class="text-gray-600 text-sm">View your key management activity</p>
                </div>
                <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-primary"></i>
            </div>
        </a>

        <a href="{{ route('profile.shift-history') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:border-primary hover:bg-blue-50 transition-colors group">
            <div class="flex items-center space-x-4">
                <div class="bg-warning text-white p-3 rounded-lg group-hover:bg-orange-500 transition-colors">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Shift History</h3>
                    <p class="text-gray-600 text-sm">View your security shift records</p>
                </div>
                <i class="fas fa-chevron-right text-gray-400 ml-auto group-hover:text-primary"></i>
            </div>
        </a>
    </div>
</div>
@endsection
