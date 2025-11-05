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
