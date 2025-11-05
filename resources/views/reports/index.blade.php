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
