# Step 9: Generate All Views (Part 3)
Write-Host "Creating STU Key Management Views - Part 3..." -ForegroundColor Green

# 1. HR Dashboard View
@'
@extends('layouts.app')
@section('title', 'HR Dashboard')
@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">HR Management</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="font-semibold text-lg mb-2">Employees</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $employeeCount }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="font-semibold text-lg mb-2">Departments</h2>
            <p class="text-3xl font-bold text-green-600">{{ $departmentCount }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="font-semibold text-lg mb-2">Active Staff</h2>
            <p class="text-3xl font-bold text-yellow-600">{{ $activeStaff }}</p>
        </div>
    </div>
</div>
@endsection
'@ | Out-File -FilePath .\resources\views\hr\dashboard.blade.php -Encoding UTF8

# 2. HR Import Page
@'
@extends('layouts.app')
@section('title', 'Import Staff Data')
@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Import Staff Records</h1>
    <form action="{{ route('hr.import') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf
        <input type="file" name="staff_file" class="border p-2 rounded w-full mb-4" required>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Upload</button>
    </form>
</div>
@endsection
'@ | Out-File -FilePath .\resources\views\hr\import.blade.php -Encoding UTF8

# 3. Reports Index View
@'
@extends('layouts.app')
@section('title', 'Reports')
@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Reports & Analytics</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 shadow rounded-lg">
            <h2 class="font-semibold text-lg mb-2">Key Usage Report</h2>
            <p class="text-gray-600 mb-4">Track how keys are used and returned across departments.</p>
            <a href="{{ route('reports.keys') }}" class="text-blue-600 font-medium hover:underline">View Report →</a>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <h2 class="font-semibold text-lg mb-2">Staff Activity</h2>
            <p class="text-gray-600 mb-4">Monitor staff key access frequency and late returns.</p>
            <a href="{{ route('reports.staff') }}" class="text-blue-600 font-medium hover:underline">View Report →</a>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <h2 class="font-semibold text-lg mb-2">Department Analytics</h2>
            <p class="text-gray-600 mb-4">See which departments use keys most frequently.</p>
            <a href="{{ route('reports.department') }}" class="text-blue-600 font-medium hover:underline">View Report →</a>
        </div>
    </div>
</div>
@endsection
'@ | Out-File -FilePath .\resources\views\reports\index.blade.php -Encoding UTF8

# 4. Profile Show View (Completed)
@'
@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center mb-6">
        <img src="{{ asset('images/profile.png') }}" class="h-16 w-16 rounded-full mr-4" alt="Profile">
        <div>
            <h1 class="text-2xl font-bold">{{ Auth::user()->name }}</h1>
            <p class="text-gray-600">{{ Auth::user()->email }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="font-semibold text-lg mb-4">Personal Information</h2>
            <p><strong>Phone:</strong> {{ Auth::user()->phone ?? 'N/A' }}</p>
            <p><strong>Department:</strong> {{ Auth::user()->department ?? 'N/A' }}</p>
            <p><strong>Role:</strong> {{ Auth::user()->role }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="font-semibold text-lg mb-4">Recent Activity</h2>
            <ul class="list-disc ml-6 text-gray-700">
                @foreach($activities as $activity)
                    <li>{{ $activity->description }} — <span class="text-gray-500 text-sm">{{ $activity->created_at->diffForHumans() }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold text-lg mb-4">Security Shifts</h2>
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-200 px-4 py-2 text-left">Shift</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Start</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">End</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->securityShifts as $shift)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ $shift->name }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $shift->start_time }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $shift->end_time }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ ucfirst($shift->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
'@ | Out-File -FilePath .\resources\views\profile\show.blade.php -Encoding UTF8

Write-Host "✅ Step 9 views created successfully!" -ForegroundColor Green
Write-Host "📁 Views created in: HR, Reports, and Profile directories." -ForegroundColor Cyan
Write-Host "➡️ Files: hr/dashboard, hr/import, reports/index, profile/show" -ForegroundColor Yellow
