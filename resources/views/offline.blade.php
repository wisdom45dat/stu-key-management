@extends('layouts.app')
@section('title', 'Offline')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 dark:from-gray-900 dark:to-blue-900/20 flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Offline Illustration -->
        <div class="text-center mb-8">
            <div class="relative inline-block mb-6">
                <div class="w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-600 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                    </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">
                You're Offline
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
                It looks like you've lost your internet connection. Don't worry, we'll get you back online soon.
            </p>
        </div>

        <!-- Connection Status Card -->
        <div class="glass-card rounded-2xl shadow-lg border border-red-200 dark:border-red-800/50 p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 dark:text-white">Connection Lost</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Last seen: <span id="last-seen">Just now</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-red-600 dark:text-red-400">Offline</span>
                </div>
            </div>
            
            <!-- Connection Progress -->
            <div class="space-y-3">
                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                    <span>Attempting to reconnect...</span>
                    <span id="retry-count">0</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div id="connection-progress" class="h-2 rounded-full bg-red-500 transition-all duration-1000" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- What You Can Do -->
        <div class="glass-card rounded-2xl shadow-lg border border-blue-200 dark:border-blue-800/50 p-6 mb-6">
            <h3 class="font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                What You Can Do
            </h3>
            <div class="space-y-3">
                <div class="flex items-start space-x-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Check Your Connection</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Verify Wi-Fi or mobile data is enabled</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Refresh the Page</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Try reloading once connection is restored</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Wait Patiently</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">We'll automatically reconnect when possible</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Offline Features -->
        <div class="glass-card rounded-2xl shadow-lg border border-green-200 dark:border-green-800/50 p-6">
            <h3 class="font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Available Offline
            </h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="text-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-xs font-medium text-gray-900 dark:text-white">Saved Documents</p>
                </div>
                <div class="text-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="text-xs font-medium text-gray-900 dark:text-white">Local Data</p>
                </div>
                <div class="text-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs font-medium text-gray-900 dark:text-white">Recent Work</p>
                </div>
                <div class="text-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <p class="text-xs font-medium text-gray-900 dark:text-white">Cached Pages</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex flex-col sm:flex-row gap-3">
            <button onclick="attemptReconnection()" class="reconnect-btn group flex-1">
                <svg class="w-4 h-4 mr-2 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Try Again
            </button>
            <button onclick="goToHomepage()" class="homepage-btn flex-1">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Go Home
            </button>
        </div>

        <!-- Connection Status Indicator -->
        <div class="mt-6 text-center">
            <div id="connection-status" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 002 0V8a1 1 0 00-1-1zm4 0a1 1 0 00-1 1v4a1 1 0 002 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                No Internet Connection
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .dark .glass-card {
        background: rgba(30, 41, 59, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .reconnect-btn {
        @apply inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2;
    }
    
    .homepage-btn {
        @apply inline-flex items-center justify-center px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2;
    }
    
    /* Animation for the offline icon */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>

<script>
    let retryCount = 0;
    const maxRetries = 5;
    let reconnectInterval;

    // Update last seen time
    document.getElementById('last-seen').textContent = new Date().toLocaleTimeString();

    function attemptReconnection() {
        const reconnectBtn = document.querySelector('.reconnect-btn');
        const progressBar = document.getElementById('connection-progress');
        const retryCountElement = document.getElementById('retry-count');
        
        // Disable button and show loading state
        reconnectBtn.disabled = true;
        reconnectBtn.innerHTML = `
            <div class="spinner border-2 border-white border-t-transparent rounded-full w-4 h-4 animate-spin mr-2"></div>
            Connecting...
        `;
        
        // Simulate connection attempt
        retryCount++;
        retryCountElement.textContent = retryCount;
        
        // Animate progress bar
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += Math.random() * 20;
            if (progress >= 100) {
                progress = 100;
                clearInterval(progressInterval);
                checkConnection();
            }
            progressBar.style.width = progress + '%';
        }, 200);
    }

    function checkConnection() {
        // Simulate connection check
        setTimeout(() => {
            const isOnline = Math.random() > 0.7; // 30% chance of success for demo
            
            if (isOnline || retryCount >= maxRetries) {
                // Connection successful or max retries reached
                if (isOnline) {
                    showSuccessMessage();
                } else {
                    showFailureMessage();
                }
                clearInterval(reconnectInterval);
            } else {
                // Continue retrying
                const reconnectBtn = document.querySelector('.reconnect-btn');
                reconnectBtn.disabled = false;
                reconnectBtn.innerHTML = `
                    <svg class="w-4 h-4 mr-2 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Try Again (${maxRetries - retryCount} left)
                `;
                
                // Auto-retry after 3 seconds
                setTimeout(attemptReconnection, 3000);
            }
        }, 1500);
    }

    function showSuccessMessage() {
        const statusElement = document.getElementById('connection-status');
        statusElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400';
        statusElement.innerHTML = `
            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            Connection Restored! Redirecting...
        `;
        
        // Redirect to homepage after 2 seconds
        setTimeout(() => {
            window.location.href = '/';
        }, 2000);
    }

    function showFailureMessage() {
        const statusElement = document.getElementById('connection-status');
        statusElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400';
        statusElement.innerHTML = `
            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            Still offline. Please check your connection.
        `;
        
        const reconnectBtn = document.querySelector('.reconnect-btn');
        reconnectBtn.disabled = false;
        reconnectBtn.textContent = 'Try Again';
    }

    function goToHomepage() {
        window.location.href = '/';
    }

    // Start auto-retry
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(attemptReconnection, 2000);
        
        // Listen for online/offline events
        window.addEventListener('online', () => {
            showSuccessMessage();
        });
        
        window.addEventListener('offline', () => {
            // Update status if user goes offline again
            const statusElement = document.getElementById('connection-status');
            statusElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400';
            statusElement.innerHTML = `
                <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 002 0V8a1 1 0 00-1-1zm4 0a1 1 0 00-1 1v4a1 1 0 002 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                No Internet Connection
            `;
        });
    });
</script>
@endsection