@extends('layouts.app')

@section('title', 'Audit Logs')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Audit Logs 📊</h1>
            <p class="text-gray-600">System activity and security events</p>
        </div>

        <!-- Success Message -->
        <div id="success-message" class="hidden bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-medium text-green-800" id="success-text">Action completed successfully!</p>
                    </div>
                </div>
                <button id="close-success" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                    <select id="date-range" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="today">Today</option>
                        <option value="7" selected>Last 7 days</option>
                        <option value="30">Last 30 days</option>
                        <option value="custom">Custom range</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Event Type</label>
                    <select id="event-type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all">All Events</option>
                        <option value="login">User Login</option>
                        <option value="checkout">Key Checkout</option>
                        <option value="return">Key Return</option>
                        <option value="system">System Changes</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">User</label>
                    <select id="user-filter" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all">All Users</option>
                        <option value="admin">System Administrator</option>
                        <option value="security">Security Officer</option>
                        <option value="hr">HR Manager</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button id="apply-filters" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-filter mr-2"></i>Apply Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Audit Logs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
                    <button id="export-logs" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-download mr-2"></i>Export Logs
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <div id="logs-container" class="space-y-4">
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-sign-in-alt text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">User Login</p>
                                <p class="text-sm text-gray-600">System Administrator logged in successfully</p>
                                <p class="text-xs text-gray-500">IP: 192.168.1.100 • Browser: Chrome</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-500">Just now</span>
                            <span class="block text-xs text-green-600 font-medium">Success</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-key text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Key Access</p>
                                <p class="text-sm text-gray-600">Security Officer accessed key management</p>
                                <p class="text-xs text-gray-500">Module: Kiosk • Action: View</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-500">2 hours ago</span>
                            <span class="block text-xs text-green-600 font-medium">Success</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-cog text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">System Update</p>
                                <p class="text-sm text-gray-600">Admin dashboard configuration updated</p>
                                <p class="text-xs text-gray-500">Changed: User permissions • By: System Administrator</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-sm text-gray-500">1 day ago</span>
                            <span class="block text-xs text-green-600 font-medium">Success</span>
                        </div>
                    </div>

                    <div id="no-logs-message" class="hidden text-center py-8 text-gray-500">
                        <i class="fas fa-search text-3xl mb-2 opacity-50"></i>
                        <p>No audit logs match your filters</p>
                        <p class="text-sm mt-1">Try adjusting your filter criteria</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Log Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-sign-in-alt text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Logins</p>
                        <p class="text-2xl font-bold text-gray-900" id="total-logins">47</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-key text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Key Activities</p>
                        <p class="text-2xl font-bold text-gray-900" id="key-activities">128</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-cog text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">System Changes</p>
                        <p class="text-2xl font-bold text-gray-900" id="system-changes">23</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="bg-red-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Security Events</p>
                        <p class="text-2xl font-bold text-gray-900" id="security-events">2</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const originalLogs = [
        {
            type: 'login',
            title: 'User Login',
            description: 'System Administrator logged in successfully',
            details: 'IP: 192.168.1.100 • Browser: Chrome',
            time: 'Just now',
            status: 'success',
            user: 'admin',
            icon: 'sign-in-alt',
            color: 'green'
        },
        {
            type: 'checkout',
            title: 'Key Access',
            description: 'Security Officer accessed key management',
            details: 'Module: Kiosk • Action: View',
            time: '2 hours ago',
            status: 'success',
            user: 'security',
            icon: 'key',
            color: 'blue'
        },
        {
            type: 'system',
            title: 'System Update',
            description: 'Admin dashboard configuration updated',
            details: 'Changed: User permissions • By: System Administrator',
            time: '1 day ago',
            status: 'success',
            user: 'admin',
            icon: 'user-cog',
            color: 'purple'
        },
        {
            type: 'login',
            title: 'User Login',
            description: 'HR Manager logged in from mobile device',
            details: 'IP: 192.168.1.105 • Browser: Safari Mobile',
            time: '3 days ago',
            status: 'success',
            user: 'hr',
            icon: 'sign-in-alt',
            color: 'green'
        },
        {
            type: 'return',
            title: 'Key Return',
            description: 'Classroom key returned after hours',
            details: 'Key: C301 • Duration: 6.5 hours • User: Faculty Member',
            time: '4 days ago',
            status: 'success',
            user: 'security',
            icon: 'key',
            color: 'blue'
        },
        {
            type: 'system',
            title: 'User Management',
            description: 'New employee account created',
            details: 'User: John Smith • Department: IT • Role: Basic Access',
            time: '1 week ago',
            status: 'success',
            user: 'admin',
            icon: 'user-plus',
            color: 'purple'
        }
    ];

    // Apply Filters Button
    document.getElementById('apply-filters').addEventListener('click', function() {
        const dateRange = document.getElementById('date-range').value;
        const eventType = document.getElementById('event-type').value;
        const userFilter = document.getElementById('user-filter').value;
        
        // Show loading state
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Applying...';
        this.disabled = true;
        
        setTimeout(() => {
            filterLogs(dateRange, eventType, userFilter);
            updateStatistics(eventType, userFilter);
            
            // Reset button
            this.innerHTML = '<i class="fas fa-filter mr-2"></i>Apply Filters';
            this.disabled = false;
            
            // Show success message
            showSuccess('Filters applied successfully! Showing filtered audit logs.');
        }, 1000);
    });
    
    // Export Logs Button
    document.getElementById('export-logs').addEventListener('click', function() {
        const dateRange = document.getElementById('date-range').value;
        const eventType = document.getElementById('event-type').value;
        const userFilter = document.getElementById('user-filter').value;
        
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
        this.disabled = true;
        
        setTimeout(() => {
            showSuccess(`Logs exported successfully! Would generate CSV file with ${getFilteredLogsCount()} records.`);
            
            this.innerHTML = '<i class="fas fa-download mr-2"></i>Export Logs';
            this.disabled = false;
        }, 1500);
    });
    
    // Close Success Message
    document.getElementById('close-success').addEventListener('click', function() {
        document.getElementById('success-message').classList.add('hidden');
    });
    
    function filterLogs(dateRange, eventType, userFilter) {
        const logsContainer = document.getElementById('logs-container');
        const noLogsMessage = document.getElementById('no-logs-message');
        
        // Clear current logs (except the no logs message)
        const logElements = logsContainer.querySelectorAll('.flex.items-center.justify-between');
        logElements.forEach(log => log.remove());
        
        // Filter logs
        const filteredLogs = originalLogs.filter(log => {
            const matchesEvent = eventType === 'all' || log.type === eventType;
            const matchesUser = userFilter === 'all' || log.user === userFilter;
            return matchesEvent && matchesUser;
        });
        
        // Show no logs message if no results
        if (filteredLogs.length === 0) {
            noLogsMessage.classList.remove('hidden');
            return;
        }
        
        noLogsMessage.classList.add('hidden');
        
        // Add filtered logs
        filteredLogs.forEach(log => {
            const logElement = document.createElement('div');
            logElement.className = 'flex items-center justify-between p-4 border border-gray-200 rounded-lg';
            logElement.innerHTML = `
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-${log.color}-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-${log.icon} text-${log.color}-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">${log.title}</p>
                        <p class="text-sm text-gray-600">${log.description}</p>
                        <p class="text-xs text-gray-500">${log.details}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-sm text-gray-500">${log.time}</span>
                    <span class="block text-xs text-${log.color}-600 font-medium">${log.status}</span>
                </div>
            `;
            logsContainer.insertBefore(logElement, noLogsMessage);
        });
    }
    
    function updateStatistics(eventType, userFilter) {
        const filteredLogs = originalLogs.filter(log => {
            const matchesEvent = eventType === 'all' || log.type === eventType;
            const matchesUser = userFilter === 'all' || log.user === userFilter;
            return matchesEvent && matchesUser;
        });
        
        const logins = filteredLogs.filter(log => log.type === 'login').length;
        const keyActivities = filteredLogs.filter(log => log.type === 'checkout' || log.type === 'return').length;
        const systemChanges = filteredLogs.filter(log => log.type === 'system').length;
        const securityEvents = filteredLogs.filter(log => log.status === 'warning' || log.status === 'error').length;
        
        document.getElementById('total-logins').textContent = logins;
        document.getElementById('key-activities').textContent = keyActivities;
        document.getElementById('system-changes').textContent = systemChanges;
        document.getElementById('security-events').textContent = securityEvents;
    }
    
    function getFilteredLogsCount() {
        const eventType = document.getElementById('event-type').value;
        const userFilter = document.getElementById('user-filter').value;
        
        return originalLogs.filter(log => {
            const matchesEvent = eventType === 'all' || log.type === eventType;
            const matchesUser = userFilter === 'all' || log.user === userFilter;
            return matchesEvent && matchesUser;
        }).length;
    }
    
    function showSuccess(message) {
        document.getElementById('success-text').textContent = message;
        document.getElementById('success-message').classList.remove('hidden');
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            document.getElementById('success-message').classList.add('hidden');
        }, 5000);
    }
});
</script>
@endsection
