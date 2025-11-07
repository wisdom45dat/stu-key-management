@extends(''layouts.app'')

@section(''title'', ''Security Shifts'')

@section(''content'')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Security Shifts</h1>
            <p class="text-gray-600 mt-2">Your shift history and activity</p>
        </div>

        <div class="p-6">
            @if($shifts->count() > 0)
            <div class="space-y-4">
                @foreach($shifts as $shift)
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">
                                Shift #{{ $shift->id }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Started: {{ $shift->start_at->format(''M j, Y g:i A'') }}
                            </p>
                            @if($shift->end_at)
                            <p class="text-sm text-gray-600">
                                Ended: {{ $shift->end_at->format(''M j, Y g:i A'') }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Duration: {{ $shift->start_at->diffInHours($shift->end_at) }} hours
                            </p>
                            @else
                            <p class="text-sm text-green-600 font-medium">
                                ● Active
                            </p>
                            @endif
                        </div>
                        <div class="text-right">
                            @if($shift->end_at)
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                Completed
                            </span>
                            @else
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                Active
                            </span>
                            @endif
                        </div>
                    </div>
                    @if($shift->notes)
                    <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-700">{{ $shift->notes }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $shifts->links() }}
            </div>
            @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-clock text-4xl mb-3 opacity-50"></i>
                <p class="text-lg">No shift history found</p>
                <p class="text-sm mt-2">Your shift records will appear here once you start working.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
