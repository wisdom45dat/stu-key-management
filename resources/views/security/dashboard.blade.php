@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Security Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Active Keys -->
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h2 class="font-semibold text-lg">Active Keys</h2>
            <p class="text-3xl mt-2">{{ $activeKeys ?? 0 }}</p>
        </div>

        <!-- Checked Out Keys -->
        <div class="bg-yellow-100 p-4 rounded-lg shadow">
            <h2 class="font-semibold text-lg">Checked Out Keys</h2>
            <p class="text-3xl mt-2">{{ $checkedOutKeys ?? 0 }}</p>
        </div>

        <!-- Staff on Shift -->
        <div class="bg-blue-100 p-4 rounded-lg shadow">
            <h2 class="font-semibold text-lg">Staff on Shift</h2>
            <p class="text-3xl mt-2">{{ $staffOnShift ?? 0 }}</p>
        </div>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Recent Key Activity</h2>
        <table class="w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 text-left">Key</th>
                    <th class="p-2 text-left">Checked Out By</th>
                    <th class="p-2 text-left">Time</th>
                    <th class="p-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentActivities ?? [] as $activity)
                    <tr class="border-b">
                        <td class="p-2">{{ $activity->key_name }}</td>
                        <td class="p-2">{{ $activity->user_name }}</td>
                        <td class="p-2">{{ $activity->time }}</td>
                        <td class="p-2">{{ $activity->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
