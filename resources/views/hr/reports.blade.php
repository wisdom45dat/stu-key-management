@extends('layouts.app')

@section('title', 'HR Reports')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">HR Reports 📈</h1>
            <p class="text-gray-600">Access usage analytics and staff activity reports</p>
        </div>

        <!-- Report Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Report Type</label>
                    <select id="report-type" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        <option value="usage" selected>Access Usage Summary</option>
                        <option value="activity">Staff Activity Report</option>
                        <option value="utilization">Key Utilization</option>
                        <option value="compliance">Security Compliance</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                    <select id="date-range" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        <option value="7">Last 7 days</option>
                        <option value="30" selected>Last 30 days</option>
                        <option value="90">Last 90 days</option>
                        <option value="custom">Custom range</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                    <select id="department" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        <option value="all" selected>All Departments</option>
                        <option value="it">IT Department</option>
                        <option value="security">Security</option>
                        <option value="hr">Human Resources</option>
                        <option value="admin">Administration</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button id="generate-report" class="w-full bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition-colors">
                        <i class="fas fa-chart-bar mr-2"></i>Generate Report
                    </button>
                </div>
            </div>
        </div>

        <!-- Report Results -->
        <div id="report-results" class="hidden bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-medium text-green-800" id="report-status">Report generated successfully!</p>
                        <p class="text-sm text-green-700" id="report-details">Showing data for the last 30 days across all departments</p>
                    </div>
                </div>
                <button id="close-results" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Report Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Checkouts</p>
                        <p class="text-3xl font-bold text-pink-600 mt-2" id="total-checkouts">47</p>
                    </div>
                    <div class="bg-pink-50 p-3 rounded-lg">
                        <i class="fas fa-arrow-right text-pink-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-green-600 font-medium">+12% from last month</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Key Holders</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2" id="active-holders">23</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <i class="fas fa-key text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-green-600 font-medium">+3 new this month</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Avg. Usage Time</p>
                        <p class="text-3xl font-bold text-green-600 mt-2" id="avg-usage">4.2h</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <i class="fas fa-clock text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-red-600 font-medium">-0.5h from average</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Compliance Rate</p>
                        <p class="text-3xl font-bold text-purple-600 mt-2" id="compliance-rate">98%</p>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-lg">
                        <i class="fas fa-check-circle text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-green-600 font-medium">+2% improvement</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Checkouts vs Returns Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Key Activity Trend</h3>
                <div class="chart-container" style="position: relative; height: 300px;">
                    <canvas id="activityChart"></canvas>
                </div>
                <p class="text-sm text-gray-500 text-center mt-3">Daily key checkouts and returns over time</p>
            </div>

            <!-- Department Usage Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Usage by Department</h3>
                <div class="chart-container" style="position: relative; height: 300px;">
                    <canvas id="departmentChart"></canvas>
                </div>
                <p class="text-sm text-gray-500 text-center mt-3">Key usage distribution across departments</p>
            </div>
        </div>

        <!-- Peak Hours Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Peak Usage Hours</h3>
            <div class="chart-container" style="position: relative; height: 250px;">
                <canvas id="hoursChart"></canvas>
            </div>
            <p class="text-sm text-gray-500 text-center mt-3">Average key checkouts by hour of day</p>
        </div>

        <!-- Sample Data Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Sample Report Data</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keys Accessed</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Activity</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">John Smith</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">IT</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">5</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">18.5 hours</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Today</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Sarah Johnson</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Security</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">12</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">42.3 hours</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yesterday</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mike Wilson</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">HR</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">8.2 hours</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 days ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Export Options -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Export Report</h3>
            <div class="flex space-x-4">
                <button id="export-excel" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-file-excel mr-2"></i>Export to Excel
                </button>
                <button id="export-pdf" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Export to PDF
                </button>
                <button id="print-report" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-print mr-2"></i>Print Report
                </button>
            </div>
            <div id="export-status" class="mt-4 hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                    <p class="text-blue-800" id="export-message">Export functionality would be implemented here</p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let activityChart, departmentChart, hoursChart;
    
    // Initialize charts
    initializeCharts();
    
    // Generate Report Button
    document.getElementById('generate-report').addEventListener('click', function() {
        const reportType = document.getElementById('report-type').value;
        const dateRange = document.getElementById('date-range').value;
        const department = document.getElementById('department').value;
        
        const reportTypes = {
            'usage': 'Access Usage Summary',
            'activity': 'Staff Activity Report', 
            'utilization': 'Key Utilization',
            'compliance': 'Security Compliance'
        };
        
        const dateRanges = {
            '7': 'last 7 days',
            '30': 'last 30 days',
            '90': 'last 90 days',
            'custom': 'custom date range'
        };
        
        const departments = {
            'all': 'all departments',
            'it': 'IT Department',
            'security': 'Security',
            'hr': 'Human Resources',
            'admin': 'Administration'
        };
        
        document.getElementById('report-details').textContent = 
            `Showing ${reportTypes[reportType]} for ${dateRanges[dateRange]} in ${departments[department]}`;
        
        document.getElementById('report-results').classList.remove('hidden');
        
        // Update stats based on filters
        updateStats(dateRange, department);
        
        // Update charts based on filters
        updateCharts(dateRange, department);
        
        // Simulate loading
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating...';
        this.disabled = true;
        
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-chart-bar mr-2"></i>Generate Report';
            this.disabled = false;
        }, 1500);
    });
    
    // Close Results
    document.getElementById('close-results').addEventListener('click', function() {
        document.getElementById('report-results').classList.add('hidden');
    });
    
    // Export Buttons
    document.getElementById('export-excel').addEventListener('click', function() {
        showExportMessage('Excel export would generate a .xlsx file with all report data and charts');
    });
    
    document.getElementById('export-pdf').addEventListener('click', function() {
        showExportMessage('PDF export would create a formatted report document with embedded charts');
    });
    
    document.getElementById('print-report').addEventListener('click', function() {
        showExportMessage('Print functionality would open browser print dialog with optimized layout for printing');
        // In a real implementation: window.print();
    });
    
    function showExportMessage(message) {
        const exportStatus = document.getElementById('export-status');
        const exportMessage = document.getElementById('export-message');
        
        exportMessage.textContent = message;
        exportStatus.classList.remove('hidden');
        
        setTimeout(() => {
            exportStatus.classList.add('hidden');
        }, 3000);
    }
    
    function initializeCharts() {
        // Activity Chart (Line Chart)
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        activityChart = new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [
                    {
                        label: 'Key Checkouts',
                        data: [12, 19, 15, 17, 14, 8, 5],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Key Returns',
                        data: [10, 16, 13, 15, 12, 7, 4],
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Keys'
                        }
                    }
                }
            }
        });
        
        // Department Chart (Doughnut)
        const departmentCtx = document.getElementById('departmentChart').getContext('2d');
        departmentChart = new Chart(departmentCtx, {
            type: 'doughnut',
            data: {
                labels: ['IT', 'Security', 'HR', 'Admin', 'Faculty'],
                datasets: [{
                    data: [35, 25, 15, 15, 10],
                    backgroundColor: [
                        '#8B5CF6',
                        '#3B82F6',
                        '#EC4899',
                        '#10B981',
                        '#F59E0B'
                    ],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        // Hours Chart (Bar)
        const hoursCtx = document.getElementById('hoursChart').getContext('2d');
        hoursChart = new Chart(hoursCtx, {
            type: 'bar',
            data: {
                labels: ['6AM', '8AM', '10AM', '12PM', '2PM', '4PM', '6PM', '8PM'],
                datasets: [{
                    label: 'Average Checkouts',
                    data: [2, 8, 12, 15, 14, 10, 6, 3],
                    backgroundColor: '#EC4899',
                    borderColor: '#EC4899',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Checkouts'
                        }
                    }
                }
            }
        });
    }
    
    function updateStats(dateRange, department) {
        // Simulate different data based on filters
        const statsData = {
            '7_all': { checkouts: 32, holders: 18, usage: '3.8h', compliance: '96%' },
            '30_all': { checkouts: 47, holders: 23, usage: '4.2h', compliance: '98%' },
            '90_all': { checkouts: 128, holders: 25, usage: '4.5h', compliance: '97%' },
            '30_it': { checkouts: 15, holders: 8, usage: '5.1h', compliance: '99%' },
            '30_security': { checkouts: 22, holders: 5, usage: '6.3h', compliance: '100%' },
            '30_hr': { checkouts: 8, holders: 3, usage: '2.8h', compliance: '95%' }
        };
        
        const key = `${dateRange}_${department}`;
        const data = statsData[key] || statsData['30_all'];
        
        document.getElementById('total-checkouts').textContent = data.checkouts;
        document.getElementById('active-holders').textContent = data.holders;
        document.getElementById('avg-usage').textContent = data.usage;
        document.getElementById('compliance-rate').textContent = data.compliance;
    }
    
    function updateCharts(dateRange, department) {
        // Simulate different chart data based on filters
        const chartData = {
            '7': {
                activity: {
                    checkouts: [8, 12, 10, 14, 11, 6, 4],
                    returns: [7, 10, 9, 12, 10, 5, 3]
                },
                departments: [20, 30, 15, 20, 15],
                hours: [1, 6, 9, 12, 11, 8, 4, 2]
            },
            '30': {
                activity: {
                    checkouts: [12, 19, 15, 17, 14, 8, 5],
                    returns: [10, 16, 13, 15, 12, 7, 4]
                },
                departments: [35, 25, 15, 15, 10],
                hours: [2, 8, 12, 15, 14, 10, 6, 3]
            },
            '90': {
                activity: {
                    checkouts: [15, 22, 18, 20, 17, 10, 7],
                    returns: [13, 19, 16, 18, 15, 9, 6]
                },
                departments: [40, 30, 10, 12, 8],
                hours: [3, 10, 15, 18, 16, 12, 8, 4]
            }
        };
        
        const data = chartData[dateRange] || chartData['30'];
        
        // Update activity chart
        activityChart.data.datasets[0].data = data.activity.checkouts;
        activityChart.data.datasets[1].data = data.activity.returns;
        activityChart.update();
        
        // Update department chart
        departmentChart.data.datasets[0].data = data.departments;
        departmentChart.update();
        
        // Update hours chart
        hoursChart.data.datasets[0].data = data.hours;
        hoursChart.update();
    }
});
</script>
@endsection
