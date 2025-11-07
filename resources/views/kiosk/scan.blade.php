<!DOCTYPE html>
<html>
<head>
    <title>Scan Key - STU Key Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        #scanner-view {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
        #video {
            width: 100%;
            border-radius: 8px;
            background: #000;
        }
        #scan-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            border: 2px solid #10B981;
            border-radius: 8px;
            pointer-events: none;
        }
        .scanner-active {
            border-color: #10B981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { border-color: #10B981; }
            50% { border-color: #34D399; }
            100% { border-color: #10B981; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-qrcode text-3xl text-purple-600 mr-4"></i>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Scan Key QR Code</h1>
                            <p class="text-gray-600">Use your camera to scan key QR codes</p>
                        </div>
                    </div>
                    <button onclick="goBack()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </button>
                </div>
            </div>
        </div>

        <!-- Scanner Area -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">QR Code Scanner</h2>
                
                <!-- Scanner Container -->
                <div id="scanner-container" class="border-2 border-dashed border-gray-300 rounded-lg p-4 mb-4">
                    <div id="scanner-view">
                        <div id="scanner-placeholder" class="text-center text-gray-500 py-16">
                            <i class="fas fa-camera text-4xl mb-3 opacity-50"></i>
                            <p class="text-lg">Camera scanner</p>
                            <p class="text-sm mt-1">Click "Start Scanner" to begin</p>
                        </div>
                        <video id="video" class="hidden" autoplay playsinline></video>
                        <div id="scan-overlay" class="hidden pulse"></div>
                    </div>
                </div>

                <!-- Scanner Status -->
                <div id="scanner-status" class="text-center mb-4">
                    <p class="text-sm text-gray-600">Scanner is ready</p>
                </div>

                <!-- Scanner Controls -->
                <div class="flex space-x-4 mb-6 justify-center">
                    <button id="start-scanner" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium">
                        <i class="fas fa-play mr-2"></i>Start Scanner
                    </button>
                    <button id="stop-scanner" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors font-medium hidden">
                        <i class="fas fa-stop mr-2"></i>Stop Scanner
                    </button>
                </div>

                <!-- Scan Result -->
                <div id="scan-result" class="hidden bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                    <h3 class="font-semibold text-green-800 mb-2 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>Scan Successful!
                    </h3>
                    <p id="result-text" class="text-green-700 font-mono text-lg"></p>
                    <div class="mt-3 flex space-x-2">
                        <button id="process-scan" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm">
                            Process This Key
                        </button>
                        <button id="scan-again" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm">
                            Scan Another
                        </button>
                    </div>
                </div>

                <!-- Manual Entry -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Manual Key Entry</h3>
                    <div class="flex space-x-4 mb-2">
                        <input type="text" id="manual-code" placeholder="Enter key code (e.g., A101, B205)" 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <button id="manual-submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Submit
                        </button>
                    </div>
                    <p class="text-sm text-gray-600">Enter the key code manually if scanning doesn't work.</p>
                </div>
            </div>

            <!-- Test Keys Section -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mt-6">
                <h3 class="font-semibold text-yellow-800 mb-3 flex items-center">
                    <i class="fas fa-vial mr-2"></i>Test Key Codes
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    <button onclick="simulateScan('A101')" class="bg-white border border-yellow-300 rounded-lg p-3 text-center hover:bg-yellow-50 transition-colors">
                        <div class="font-mono font-bold text-yellow-700">A101</div>
                        <div class="text-xs text-yellow-600">Office Key</div>
                    </button>
                    <button onclick="simulateScan('B205')" class="bg-white border border-yellow-300 rounded-lg p-3 text-center hover:bg-yellow-50 transition-colors">
                        <div class="font-mono font-bold text-yellow-700">B205</div>
                        <div class="text-xs text-yellow-600">Server Room</div>
                    </button>
                    <button onclick="simulateScan('C301')" class="bg-white border border-yellow-300 rounded-lg p-3 text-center hover:bg-yellow-50 transition-colors">
                        <div class="font-mono font-bold text-yellow-700">C301</div>
                        <div class="text-xs text-yellow-600">Classroom</div>
                    </button>
                    <button onclick="simulateScan('D412')" class="bg-white border border-yellow-300 rounded-lg p-3 text-center hover:bg-yellow-50 transition-colors">
                        <div class="font-mono font-bold text-yellow-700">D412</div>
                        <div class="text-xs text-yellow-600">Lab Key</div>
                    </button>
                </div>
                <p class="text-sm text-yellow-700 mt-2">Click any test key to simulate a QR scan for testing.</p>
            </div>

            <!-- Instructions -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mt-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="text-blue-800 font-medium">How to Use the Scanner</p>
                        <ul class="text-blue-700 text-sm mt-1 list-disc list-inside space-y-1">
                            <li>Click "Start Scanner" and allow camera access when prompted</li>
                            <li>Point your camera at a key QR code - ensure good lighting</li>
                            <li>Hold steady - the scanner will detect codes automatically</li>
                            <li>Use test keys above to simulate scanning for development</li>
                            <li>Use manual entry if camera is not available</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let stream = null;
        let scanInterval = null;
        
        // DOM elements
        const video = document.getElementById('video');
        const startBtn = document.getElementById('start-scanner');
        const stopBtn = document.getElementById('stop-scanner');
        const placeholder = document.getElementById('scanner-placeholder');
        const overlay = document.getElementById('scan-overlay');
        const status = document.getElementById('scanner-status');
        const scanResult = document.getElementById('scan-result');
        const resultText = document.getElementById('result-text');
        
        // Event listeners
        startBtn.addEventListener('click', startScanner);
        stopBtn.addEventListener('click', stopScanner);
        document.getElementById('manual-submit').addEventListener('click', processManualEntry);
        document.getElementById('process-scan').addEventListener('click', processScannedCode);
        document.getElementById('scan-again').addEventListener('click', scanAgain);
        
        // Enter key for manual input
        document.getElementById('manual-code').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                processManualEntry();
            }
        });
        
        async function startScanner() {
            try {
                console.log('Starting scanner...');
                
                // Request camera access
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'environment', // Prefer rear camera
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    },
                    audio: false
                });
                
                console.log('Camera access granted');
                
                // Set up video element
                video.srcObject = stream;
                video.classList.remove('hidden');
                
                // Hide placeholder, show video and overlay
                placeholder.classList.add('hidden');
                overlay.classList.remove('hidden');
                
                // Update UI
                startBtn.classList.add('hidden');
                stopBtn.classList.remove('hidden');
                document.getElementById('scanner-container').classList.add('scanner-active');
                status.innerHTML = '<p class="text-sm text-green-600"><i class="fas fa-circle mr-1"></i>Scanner active - point at QR code</p>';
                
                // Start simulated QR detection
                startQRDetection();
                
            } catch (error) {
                console.error('Error starting scanner:', error);
                status.innerHTML = '<p class="text-sm text-red-600"><i class="fas fa-exclamation-triangle mr-1"></i>Camera error: ' + error.message + '</p>';
                showManualEntryHelp();
            }
        }
        
        function stopScanner() {
            console.log('Stopping scanner...');
            
            // Stop camera stream
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            
            // Clear detection interval
            if (scanInterval) {
                clearInterval(scanInterval);
                scanInterval = null;
            }
            
            // Reset UI
            video.classList.add('hidden');
            placeholder.classList.remove('hidden');
            overlay.classList.add('hidden');
            startBtn.classList.remove('hidden');
            stopBtn.classList.add('hidden');
            document.getElementById('scanner-container').classList.remove('scanner-active');
            status.innerHTML = '<p class="text-sm text-gray-600">Scanner is ready</p>';
        }
        
        function startQRDetection() {
            // Simulate QR code detection (in real app, you'd use a QR library)
            scanInterval = setInterval(() => {
                // Random chance to detect a QR code for demo
                if (Math.random() < 0.03) { // 3% chance per check
                    const testCodes = ['A101', 'B205', 'C301', 'D412', 'E509'];
                    const randomCode = testCodes[Math.floor(Math.random() * testCodes.length)];
                    onQRDetected(randomCode);
                }
            }, 1000);
        }
        
        function onQRDetected(code) {
            console.log('QR Code detected:', code);
            stopScanner();
            showScanResult(code);
        }
        
        function showScanResult(code) {
            resultText.textContent = `Key Code: ${code}`;
            scanResult.classList.remove('hidden');
            scanResult.dataset.scannedCode = code;
            
            // Scroll to result
            scanResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
        
        function processManualEntry() {
            const manualCode = document.getElementById('manual-code').value.trim().toUpperCase();
            if (manualCode) {
                showScanResult(manualCode);
                document.getElementById('manual-code').value = '';
            } else {
                alert('Please enter a key code');
                document.getElementById('manual-code').focus();
            }
        }
        
        function processScannedCode() {
            const code = scanResult.dataset.scannedCode;
            if (code) {
                // Redirect to checkout with the scanned code
                window.location.href = `/kiosk/checkout?scan=${encodeURIComponent(code)}`;
            }
        }
        
        function scanAgain() {
            scanResult.classList.add('hidden');
            scanResult.dataset.scannedCode = '';
            startScanner();
        }
        
        function simulateScan(code) {
            console.log('Simulating scan for:', code);
            if (stream) {
                // If scanner is active, simulate detection
                onQRDetected(code);
            } else {
                // If scanner not active, just show result
                showScanResult(code);
            }
        }
        
        function showManualEntryHelp() {
            const manualSection = document.querySelector('.bg-gray-50');
            manualSection.classList.add('border-yellow-300', 'bg-yellow-50');
            
            setTimeout(() => {
                manualSection.classList.remove('border-yellow-300', 'bg-yellow-50');
            }, 3000);
        }
        
        function goBack() {
            // Stop scanner if active
            if (stream) {
                stopScanner();
            }
            
            if (document.referrer && document.referrer.includes(window.location.host)) {
                window.history.back();
            } else {
                window.location.href = '/kiosk';
            }
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                goBack();
            }
            if (event.key === ' ' && !stream) { // Space to start scanner
                startScanner();
                event.preventDefault();
            }
        });
        
        // Clean up on page unload
        window.addEventListener('beforeunload', function() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        });
    </script>
</body>
</html>
