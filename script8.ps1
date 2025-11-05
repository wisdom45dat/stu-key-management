# Step 8: Create Kiosk and Keys Views

# 7. Create Kiosk Checkout View (continued)
@'
<script>
let signaturePad;
let cameraStream;

document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('signature-pad');
    signaturePad = new SignaturePad(canvas);

    const searchInput = document.getElementById('staff-search');
    const searchResults = document.getElementById('search-results');
    const selectedStaff = document.getElementById('selected-staff');
    const submitBtn = document.getElementById('submit-btn');

    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.trim();
        if (query.length < 2) {
            searchResults.classList.add('hidden');
            return;
        }

        fetch(`{{ route('kiosk.search-holder') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => displaySearchResults(data))
            .catch(error => console.error('Search error:', error));
    });

    function displaySearchResults(results) {
        if (results.length === 0) {
            searchResults.innerHTML = `
                <div class="p-4 text-center text-gray-500">
                    No staff members found. 
                    <button type="button" onclick="showAddStaffOptions()" class="text-blue-600 hover:text-blue-800 ml-1">
                        Add new staff?
                    </button>
                </div>
            `;
        } else {
            searchResults.innerHTML = results.map(staff => `
                <div class="p-3 border-b border-gray-200 hover:bg-gray-50 cursor-pointer" 
                     onclick="selectStaff(${JSON.stringify(staff).replace(/"/g, '&quot;')})">
                    <div class="font-medium text-gray-900">${staff.name}</div>
                    <div class="text-sm text-gray-600">${staff.phone} • ${staff.type_label}</div>
                    ${staff.dept ? `<div class="text-sm text-gray-500">${staff.dept}</div>` : ''}
                </div>
            `).join('');
        }
        searchResults.classList.remove('hidden');
    }

    document.getElementById('photo-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview-img').src = e.target.result;
                document.getElementById('photo-preview').classList.remove('hidden');
                document.getElementById('camera-preview').classList.add('hidden');
                stopCamera();
            };
            reader.readAsDataURL(file);
        }
    });
});

function selectStaff(staff) {
    document.getElementById('holder-type').value = staff.type;
    document.getElementById('holder-id').value = staff.id;
    document.getElementById('holder-name').value = staff.name;
    document.getElementById('holder-phone').value = staff.phone;
    document.getElementById('selected-name').textContent = staff.name;
    document.getElementById('selected-details').textContent = `${staff.phone} • ${staff.type_label}`;
    document.getElementById('staff-search').value = '';
    document.getElementById('search-results').classList.add('hidden');
    document.getElementById('selected-staff').classList.remove('hidden');
    document.getElementById('submit-btn').disabled = false;
}

function clearSelection() {
    document.getElementById('selected-staff').classList.add('hidden');
    document.getElementById('submit-btn').disabled = true;
    document.getElementById('holder-type').value = '';
    document.getElementById('holder-id').value = '';
    document.getElementById('holder-name').value = '';
    document.getElementById('holder-phone').value = '';
}

function clearSignature() {
    signaturePad.clear();
    document.getElementById('signature-data').value = '';
}

function startCamera() {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
            .then(function(stream) {
                cameraStream = stream;
                const video = document.getElementById('camera-view');
                video.srcObject = stream;
                document.getElementById('camera-preview').classList.remove('hidden');
                document.getElementById('capture-btn').classList.remove('hidden');
                document.getElementById('photo-preview').classList.add('hidden');
            })
            .catch(function(error) {
                console.error('Camera error:', error);
                alert('Unable to access camera. Please use file upload instead.');
            });
    } else {
        alert('Camera not supported on this device. Please use file upload.');
    }
}

function capturePhoto() {
    const video = document.getElementById('camera-view');
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0);
    document.getElementById('photo-preview-img').src = canvas.toDataURL('image/png');
    document.getElementById('photo-preview').classList.remove('hidden');
    document.getElementById('camera-preview').classList.add('hidden');
    document.getElementById('capture-btn').classList.add('hidden');
    stopCamera();
}

function stopCamera() {
    if (cameraStream) {
        cameraStream.getTracks().forEach(track => track.stop());
        cameraStream = null;
    }
}

function showAddStaffOptions() {
    alert('Staff addition feature would be implemented here');
}

document.getElementById('checkout-form').addEventListener('submit', function(e) {
    if (!signaturePad.isEmpty()) {
        document.getElementById('signature-data').value = signaturePad.toDataURL();
    }
    const holderType = document.getElementById('holder-type').value;
    if (!holderType) {
        e.preventDefault();
        alert('Please select a staff member');
        return;
    }
});
</script>
'@ | Out-File -FilePath .\resources\views\kiosk\checkout.blade.php -Encoding UTF8 -Force

# 8. Create Kiosk Checkin View
@'
@extends('layouts.app')
...
@endsection
'@ | Out-File -FilePath .\resources\views\kiosk\checkin.blade.php -Encoding UTF8 -Force

# 9. Create Keys Index View
@'
@extends('layouts.app')
...
@endsection
'@ | Out-File -FilePath .\resources\views\keys\index.blade.php -Encoding UTF8 -Force

Write-Host "✅ Step 8 views created successfully!" -ForegroundColor Green
Write-Host "📁 Files created in resources/views/" -ForegroundColor Cyan
Write-Host "➡️ Views: kiosk/scan, kiosk/checkout, kiosk/checkin, keys/index" -ForegroundColor Yellow
