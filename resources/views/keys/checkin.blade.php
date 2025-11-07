@extends(''layouts.app'')

@section(''title'', ''Checkin Key'')

@section(''content'')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Checkin Key</h1>
        
        <div class="text-center p-6 border-2 border-dashed border-gray-300 rounded-lg">
            <i class="fas fa-key text-4xl text-green-500 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-800">{{ $key->code }}</h3>
            <p class="text-gray-600">{{ $key->label }}</p>
            <p class="text-sm text-gray-500 mt-2">{{ $key->location->name ?? ''No location'' }}</p>
            
            <div class="mt-6 p-4 bg-green-50 rounded-lg">
                <p class="text-green-800">Checkin functionality would be implemented here</p>
                <p class="text-sm text-green-700 mt-2">This would include verification and return confirmation.</p>
            </div>
            
            <div class="mt-6 flex space-x-3">
                <a href="{{ route(''keys.index'') }}" class="flex-1 bg-gray-600 text-white text-center py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    Back to Keys
                </a>
                <button class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors opacity-50 cursor-not-allowed" disabled>
                    Checkin (Demo)
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
