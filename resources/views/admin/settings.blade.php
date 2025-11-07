@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">System Settings ⚙️</h1>
            <p class="text-gray-600">Configure system preferences and security settings</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <nav class="space-y-2">
                        <a href="#general" class="block px-4 py-2 bg-purple-50 text-purple-700 rounded-lg font-medium">
                            <i class="fas fa-cog mr-2"></i>General Settings
                        </a>
                        <a href="#security" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-shield-alt mr-2"></i>Security
                        </a>
                        <a href="#notifications" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-bell mr-2"></i>Notifications
                        </a>
                        <a href="#backup" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-database mr-2"></i>Backup & Restore
                        </a>
                        <a href="#maintenance" class="block px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i class="fas fa-tools mr-2"></i>Maintenance
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Right Column - Settings -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6" id="general">General Settings</h2>
                    
                    <div class="space-y-6">
                        <!-- System Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">System Name</label>
                            <input type="text" value="STU Key Management System" 
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <p class="text-sm text-gray-500 mt-1">The display name for your key management system</p>
                        </div>

                        <!-- Timezone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option selected>(UTC+00:00) London</option>
                                <option>(UTC+01:00) Paris</option>
                                <option>(UTC-05:00) New York</option>
                                <option>(UTC+08:00) Singapore</option>
                            </select>
                        </div>

                        <!-- Date Format -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date Format</label>
                            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option selected>DD/MM/YYYY (01/12/2024)</option>
                                <option>MM/DD/YYYY (12/01/2024)</option>
                                <option>YYYY-MM-DD (2024-12-01)</option>
                            </select>
                        </div>

                        <!-- Auto Logout -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Auto Logout</label>
                            <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option>15 minutes</option>
                                <option selected>30 minutes</option>
                                <option>1 hour</option>
                                <option>2 hours</option>
                                <option>Never</option>
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Automatically log out users after period of inactivity</p>
                        </div>

                        <!-- Save Button -->
                        <div class="pt-4 border-t border-gray-200">
                            <button class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors font-medium">
                                <i class="fas fa-save mr-2"></i>Save Settings
                            </button>
                            <button class="ml-3 bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                                Reset to Defaults
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
