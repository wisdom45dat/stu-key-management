<!DOCTYPE html>
<html>
<head>
    <title>Kiosk - STU Key Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">STU Key Management Kiosk</h1>
            <p class="text-gray-600 mb-8">Choose an action below</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Checkout Card -->
                <a href="/kiosk/checkout" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="text-green-600 text-4xl mb-4">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Checkout Key</h2>
                    <p class="text-gray-600">Borrow a key from the system</p>
                </a>
                
                <!-- Checkin Card -->
                <a href="/kiosk/checkin" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Checkin Key</h2>
                    <p class="text-gray-600">Return a key to the system</p>
                </a>
                
                <!-- Scan Card -->
                <a href="/kiosk/scan" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="text-purple-600 text-4xl mb-4">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Scan QR Code</h2>
                    <p class="text-gray-600">Use camera to scan key codes</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
