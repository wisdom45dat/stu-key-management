<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

// Authentication Routes (Laravel 12 compatible)
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

// Public Routes - Show login form as default page
Route::get('/', function () {
    return redirect()->route('login');
});

// Protected Routes - Require authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard - redirect to dashboard after login
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('update-password');
        Route::get('/activity', [ProfileController::class, 'activityLog'])->name('activity');
        Route::get('/shifts', [ProfileController::class, 'shiftHistory'])->name('shift-history');
        Route::post('/shift/start', [ProfileController::class, 'startShift'])->name('start-shift');
        Route::post('/shift/end', [ProfileController::class, 'endShift'])->name('end-shift');
    });

    // Kiosk Routes
    Route::prefix('kiosk')->name('kiosk.')->middleware(['role:security', 'kiosk'])->group(function () {
        Route::get('/', [KioskController::class, 'index'])->name('index');
        Route::get('/scan', [KioskController::class, 'scan'])->name('scan');
        Route::post('/scan/process', [KioskController::class, 'processScan'])->name('process-scan');
        Route::get('/checkout/{key}', [KioskController::class, 'checkoutForm'])->name('checkout');
        Route::post('/checkout/{key}', [KioskController::class, 'processCheckout'])->name('process-checkout');
        Route::get('/checkin/{key}', [KioskController::class, 'checkinForm'])->name('checkin');
        Route::post('/checkin/{key}', [KioskController::class, 'processCheckin'])->name('process-checkin');
        Route::get('/search-holder', [KioskController::class, 'searchHolder'])->name('search-holder');
        Route::post('/temporary-staff', [KioskController::class, 'createTemporaryStaff'])->name('create-temporary-staff');
        Route::post('/permanent-manual-staff', [KioskController::class, 'createPermanentManualStaff'])->name('create-permanent-manual-staff');
    });

    // Key Management Routes
    Route::prefix('keys')->name('keys.')->middleware(['role:admin|security|hr'])->group(function () {
        Route::get('/', [KeyController::class, 'index'])->name('index');
        Route::get('/create', [KeyController::class, 'create'])->name('create')->middleware('role:admin');
        Route::post('/', [KeyController::class, 'store'])->name('store')->middleware('role:admin');
        Route::get('/{key}', [KeyController::class, 'show'])->name('show');
        Route::get('/{key}/edit', [KeyController::class, 'edit'])->name('edit')->middleware('role:admin');
        Route::put('/{key}', [KeyController::class, 'update'])->name('update')->middleware('role:admin');
        Route::delete('/{key}', [KeyController::class, 'destroy'])->name('destroy')->middleware('role:admin');
        Route::post('/{key}/generate-tags', [KeyController::class, 'generateTags'])->name('generate-tags')->middleware('role:admin');
        Route::get('/{key}/print-tags', [KeyController::class, 'printTags'])->name('print-tags')->middleware('role:admin');
        Route::post('/{key}/mark-lost', [KeyController::class, 'markAsLost'])->name('mark-lost')->middleware('role:admin|security');
    });

    // Location Management Routes
    Route::prefix('locations')->name('locations.')->middleware(['role:admin'])->group(function () {
        Route::get('/', [LocationController::class, 'index'])->name('index');
        Route::get('/create', [LocationController::class, 'create'])->name('create');
        Route::post('/', [LocationController::class, 'store'])->name('store');
        Route::get('/{location}', [LocationController::class, 'show'])->name('show');
        Route::get('/{location}/edit', [LocationController::class, 'edit'])->name('edit');
        Route::put('/{location}', [LocationController::class, 'update'])->name('update');
        Route::delete('/{location}', [LocationController::class, 'destroy'])->name('destroy');
        Route::get('/api/buildings', [LocationController::class, 'getBuildings'])->name('api.buildings');
        Route::get('/api/rooms', [LocationController::class, 'getRooms'])->name('api.rooms');
    });

    // HR Management Routes
    Route::prefix('hr')->name('hr.')->middleware(['role:admin|hr'])->group(function () {
        Route::get('/dashboard', [HrController::class, 'dashboard'])->name('dashboard');
        
        // HR Staff Routes
        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('/', [HrController::class, 'hrStaffIndex'])->name('index');
            Route::get('/{hrStaff}', [HrController::class, 'hrStaffShow'])->name('show');
        });

        // Manual Staff Routes
        Route::prefix('manual-staff')->name('manual-staff.')->group(function () {
            Route::get('/', [HrController::class, 'manualStaffIndex'])->name('index');
            Route::get('/create', [HrController::class, 'createManualStaff'])->name('create');
            Route::post('/', [HrController::class, 'storeManualStaff'])->name('store');
        });

        // Import Routes
        Route::prefix('import')->name('import.')->group(function () {
            Route::get('/hr-staff', [HrController::class, 'importHrStaffForm'])->name('form');
            Route::post('/hr-staff', [HrController::class, 'importHrStaff'])->name('hr-staff');
        });

        // Discrepancy Routes
        Route::prefix('discrepancies')->name('discrepancies.')->group(function () {
            Route::get('/', [HrController::class, 'discrepanciesIndex'])->name('index');
            Route::post('/{keyLog}/resolve', [HrController::class, 'resolveDiscrepancy'])->name('resolve');
            Route::post('/bulk-resolve', [HrController::class, 'bulkResolveDiscrepancies'])->name('bulk-resolve');
        });
    });

    // Report Routes
    Route::prefix('reports')->name('reports.')->middleware(['role:admin|hr|auditor'])->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/key-activity', [ReportController::class, 'keyActivity'])->name('key-activity');
        Route::get('/current-holders', [ReportController::class, 'currentHolders'])->name('current-holders');
        Route::get('/overdue-keys', [ReportController::class, 'overdueKeys'])->name('overdue-keys');
        Route::get('/staff-activity', [ReportController::class, 'staffActivity'])->name('staff-activity');
        Route::get('/security-performance', [ReportController::class, 'securityPerformance'])->name('security-performance');
        Route::get('/analytics', [ReportController::class, 'analyticsDashboard'])->name('analytics');
        Route::post('/export/key-activity', [ReportController::class, 'exportKeyActivity'])->name('export-key-activity');
    });

    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {
        Route::get('/users', [AdminController::class, 'userManagement'])->name('users');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('store-user');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('update-user');
        Route::get('/settings', [AdminController::class, 'systemSettings'])->name('settings');
        Route::put('/settings', [AdminController::class, 'updateSettings'])->name('update-settings');
        Route::get('/system-health', [AdminController::class, 'systemHealth'])->name('system-health');
    });
});