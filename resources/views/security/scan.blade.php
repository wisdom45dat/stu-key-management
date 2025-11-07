@extends(''layouts.app'')

@section(''title'', ''QR Scanner'')

@section(''content'')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">QR Code Scanner</h1>
        
        <div class="text-center p-8 border-2 border-dashed border-gray-300 rounded-lg mb-6">
            <i class="fas fa-qrcode text-6xl text-gray-400 mb-4"></i>
            <p class="text-gray-600 mb-4">Scanner interface would be here</p>
            <p class="text-sm text-gray-500">This feature requires camera access and would be implemented with JavaScript QR scanning library</p>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                <div>
                    <p class="text-blue-800 font-medium">Manual Key Lookup</p>
                    <p class="text-blue-700 text-sm mt-1">You can also manually check key status in the Key Management section.</p>
                </div>
            </div>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route(''keys.index'') }}" class="flex-1 bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-key mr-2"></i>Key Management
            </a>
            <a href="{{ route(''kiosk.index'') }}" class="flex-1 bg-green-600 text-white text-center py-3 rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-desktop mr-2"></i>Kiosk Mode
            </a>
        </div>
    </div>
</div>
@endsection
