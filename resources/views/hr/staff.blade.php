@extends('layouts.app')

@section('title', 'Staff Management')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Staff Management 👨‍💼</h1>
            <p class="text-gray-600">Manage employee records and access permissions</p>
        </div>

        <!-- Add Employee Modal -->
        <div id="add-employee-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Add New Employee</h3>
                        <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <form id="employee-form" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="employee-name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500" placeholder="Enter full name" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="employee-email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500" placeholder="employee@stu.edu" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select id="employee-department" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                <option value="it">IT Department</option>
                                <option value="security">Security</option>
                                <option value="hr">Human Resources</option>
                                <option value="admin">Administration</option>
                                <option value="faculty">Faculty</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                            <input type="text" id="employee-position" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500" placeholder="Job title" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Access Level</label>
                            <select id="employee-access" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                <option value="basic">Basic Access</option>
                                <option value="department">Department Access</option>
                                <option value="security">Security Access</option>
                                <option value="admin">Administrator Access</option>
                            </select>
                        </div>
                        
                        <div class="flex space-x-3 pt-4">
                            <button type="submit" class="flex-1 bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Save Employee
                            </button>
                            <button type="button" id="cancel-add" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        <div id="success-message" class="hidden bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                    <div>
                        <p class="font-medium text-green-800" id="success-text">Employee added successfully!</p>
                    </div>
                </div>
                <button id="close-success" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Staff List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">Employee Directory</h2>
                    <button id="open-modal" class="bg-pink-600 text-white px-4 py-2 rounded-lg hover:bg-pink-700 transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>Add Employee
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Access Level</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="staff-table-body">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-purple-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">System Administrator</div>
                                            <div class="text-sm text-gray-500">EMP001</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">IT Department</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">System Admin</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">Full Access</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Suspend</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-shield-alt text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Security Officer</div>
                                            <div class="text-sm text-gray-500">EMP002</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Security</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Security Officer</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Security Access</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Suspend</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user-tie text-pink-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">HR Manager</div>
                                            <div class="text-sm text-gray-500">EMP003</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Human Resources</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">HR Manager</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-pink-100 text-pink-800 rounded-full">HR Access</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Suspend</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-pink-50 border border-pink-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-pink-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-users text-pink-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-pink-800">Total Employees</p>
                        <p class="text-2xl font-bold text-pink-900" id="total-employees">3</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-user-check text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-green-800">Active Today</p>
                        <p class="text-2xl font-bold text-green-900">1</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-key text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-blue-800">Key Holders</p>
                        <p class="text-2xl font-bold text-blue-900">3</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let employeeCount = 3; // Starting count
    
    // Modal controls
    document.getElementById('open-modal').addEventListener('click', function() {
        document.getElementById('add-employee-modal').classList.remove('hidden');
    });
    
    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('add-employee-modal').classList.add('hidden');
    });
    
    document.getElementById('cancel-add').addEventListener('click', function() {
        document.getElementById('add-employee-modal').classList.add('hidden');
        document.getElementById('employee-form').reset();
    });
    
    document.getElementById('close-success').addEventListener('click', function() {
        document.getElementById('success-message').classList.add('hidden');
    });
    
    // Form submission
    document.getElementById('employee-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('employee-name').value;
        const email = document.getElementById('employee-email').value;
        const department = document.getElementById('employee-department').value;
        const position = document.getElementById('employee-position').value;
        const access = document.getElementById('employee-access').value;
        
        // Generate employee ID
        employeeCount++;
        const employeeId = 'EMP' + employeeCount.toString().padStart(3, '0');
        
        // Add to table
        addEmployeeToTable(name, employeeId, department, position, access);
        
        // Update stats
        document.getElementById('total-employees').textContent = employeeCount;
        
        // Show success message
        document.getElementById('success-text').textContent = `${name} has been added to the system!`;
        document.getElementById('success-message').classList.remove('hidden');
        
        // Close modal and reset form
        document.getElementById('add-employee-modal').classList.add('hidden');
        document.getElementById('employee-form').reset();
        
        // Scroll to show new employee
        document.getElementById('staff-table-body').scrollIntoView({ behavior: 'smooth' });
    });
    
    function addEmployeeToTable(name, id, department, position, access) {
        const departmentNames = {
            'it': 'IT Department',
            'security': 'Security', 
            'hr': 'Human Resources',
            'admin': 'Administration',
            'faculty': 'Faculty',
            'maintenance': 'Maintenance'
        };
        
        const accessNames = {
            'basic': 'Basic Access',
            'department': 'Department Access', 
            'security': 'Security Access',
            'admin': 'Administrator Access'
        };
        
        const accessColors = {
            'basic': 'gray',
            'department': 'blue', 
            'security': 'green',
            'admin': 'purple'
        };
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-${accessColors[access]}-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-${accessColors[access]}-600"></i>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">${name}</div>
                        <div class="text-sm text-gray-500">${id}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${departmentNames[department]}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${position}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-${accessColors[access]}-100 text-${accessColors[access]}-800 rounded-full">${accessNames[access]}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                <button class="text-red-600 hover:text-red-900">Suspend</button>
            </td>
        `;
        
        document.getElementById('staff-table-body').appendChild(row);
    }
});
</script>
@endsection
