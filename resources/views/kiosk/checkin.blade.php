<!DOCTYPE html>
<html>
<head>
    <title>Checkin Key - STU Key Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-arrow-left text-3xl text-blue-600 mr-4"></i>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Key Checkin</h1>
                            <p class="text-gray-600">Return keys to the system</p>
                        </div>
                    </div>
                    <button onclick="goBack()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </button>
                </div>
            </div>
        </div>

        <!-- Checked Out Keys -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Keys to Return</h2>
                
                @if(isset($checkedOutKeys) && $checkedOutKeys->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($checkedOutKeys as $key)
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-mono font-bold text-lg text-blue-600">{{ $key->code }}</span>
                            <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-medium">Checked Out</span>
                        </div>
                        <p class="text-gray-800 font-medium mb-1">{{ $key->label }}</p>
                        <p class="text-sm text-gray-600 mb-3">{{ $key->location->name ?? "No location" }}</p>
                        <div class="flex space-x-2">
                            <button class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                Checkin
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-key text-4xl mb-3 opacity-50"></i>
                    <p class="text-lg">No keys to return</p>
                    <p class="text-sm mt-2">All keys are currently available in the system.</p>
                </div>
                @endif
            </div>

            <!-- Manual Entry -->
            <div class="bg-white rounded-xl shadow-lg p-6 mt-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Manual Key Entry</h2>
                <div class="flex space-x-4">
                    <input type="text" placeholder="Enter key code" 
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Checkin
                    </button>
                </div>
                <p class="text-sm text-gray-600 mt-2">Enter the key code manually if you have it.</p>
            </div>

            <!-- Instructions -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mt-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="text-blue-800 font-medium">Checkin Process</p>
                        <p class="text-blue-700 text-sm mt-1">Select a key from the checked out list or enter the key code manually. The system will process the return.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            if (document.referrer && document.referrer.includes(window.location.host)) {
                // Go back to previous page if it's from the same site
                window.history.back();
            } else {
                // Default to kiosk page if no previous page or from different site
                window.location.href = '/kiosk';
            }
        }
        
        // Add keyboard shortcut (Esc key) to go back
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                goBack();
            }
        });
    </script>
</body>
</html>
