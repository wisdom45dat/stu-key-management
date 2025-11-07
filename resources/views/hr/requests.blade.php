@extends('layouts.app')

@section('title', 'Access Requests')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Access Requests 🔑</h1>
            <p class="text-gray-600">Approve or deny key access requests from staff</p>
        </div>

        <!-- Pending Requests -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Pending Requests</h2>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">John Smith - Office Manager</p>
                                <p class="text-sm text-gray-600">Requesting access to Main Office Key (A101)</p>
                                <p class="text-xs text-gray-500">Submitted: Today at 09:30 AM • Reason: New employee onboarding</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm">
                                <i class="fas fa-check mr-1"></i>Approve
                            </button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors text-sm">
                                <i class="fas fa-times mr-1"></i>Deny
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Sarah Johnson - IT Support</p>
                                <p class="text-sm text-gray-600">Requesting access to Server Room Key (B205)</p>
                                <p class="text-xs text-gray-500">Submitted: Yesterday at 02:15 PM • Reason: System maintenance</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm">
                                <i class="fas fa-check mr-1"></i>Approve
                            </button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors text-sm">
                                <i class="fas fa-times mr-1"></i>Deny
                            </button>
                        </div>
                    </div>

                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
                        <p>No more pending requests</p>
                        <p class="text-sm mt-1">All access requests have been processed</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Recently Processed</h2>
            </div>
            
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Approved: Classroom Key (C301)</p>
                                <p class="text-sm text-gray-600">For: Dr. Michael Brown - Professor</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">2 days ago</span>
                    </div>

                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-times text-red-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Denied: Lab Key (D412)</p>
                                <p class="text-sm text-gray-600">For: Intern - Training incomplete</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500">1 week ago</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
