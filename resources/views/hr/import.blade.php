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
