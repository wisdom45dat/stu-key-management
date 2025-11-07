@extends("layouts.app")

@section("title", "Add Key")

@section("content")
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Add New Key</h1>
        <form method="POST" action="/keys">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Key Code</label>
                <input type="text" name="code" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Key Label</label>
                <input type="text" name="label" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex space-x-4">
                <a href="/keys" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Key</button>
            </div>
        </form>
    </div>
</div>
@endsection
