<?php

use App\Http\Controllers\KioskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Main dashboard route - redirects based on user role
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Redirect based on user role
    if ($user->hasRole('admin')) {
        return redirect('/admin/dashboard');
    } elseif ($user->hasRole('hr')) {
        return redirect('/hr/dashboard');
    } elseif ($user->hasRole('security')) {
        return redirect('/security/dashboard');
    } else {
        // Default dashboard for users without specific roles
        return view('dashboard.security');
    }
})->middleware(['auth'])->name('dashboard');

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    // Check if user has admin role
    if (!auth()->user()->hasRole('admin')) {
        abort(403, 'Unauthorized access');
    }
    return view('dashboard.admin');
})->middleware(['auth'])->name('admin.dashboard');

// Admin Management Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // User Management
    Route::get('/users', function () {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.users');
    })->name('admin.users');

    // Audit Logs
    Route::get('/audit', function () {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.audit');
    })->name('admin.audit');

    // System Settings
    Route::get('/settings', function () {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
        return view('admin.settings');
    })->name('admin.settings');
});

// HR Dashboard  
Route::get('/hr/dashboard', function () {
    // Check if user has hr role
    if (!auth()->user()->hasRole('hr')) {
        abort(403, 'Unauthorized access');
    }
    return view('dashboard.hr');
})->middleware(['auth'])->name('hr.dashboard');

// HR Management Routes
Route::middleware(['auth'])->prefix('hr')->group(function () {
    // Staff Management
    Route::get('/staff', function () {
        if (!auth()->user()->hasRole('hr')) {
            abort(403, 'Unauthorized access');
        }
        return view('hr.staff');
    })->name('hr.staff');

    // Access Requests
    Route::get('/requests', function () {
        if (!auth()->user()->hasRole('hr')) {
            abort(403, 'Unauthorized access');
        }
        return view('hr.requests');
    })->name('hr.requests');

    // HR Reports
    Route::get('/reports', function () {
        if (!auth()->user()->hasRole('hr')) {
            abort(403, 'Unauthorized access');
        }
        return view('hr.reports');
    })->name('hr.reports');
});

// Security Dashboard
Route::get('/security/dashboard', function () {
    // Check if user has security role
    if (!auth()->user()->hasRole('security')) {
        abort(403, 'Unauthorized access');
    }
    return view('dashboard.security');
})->middleware(['auth'])->name('security.dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Your kiosk routes
    Route::get('/kiosk', [KioskController::class, 'index'])->name('kiosk.index');
    Route::get('/kiosk/checkout', [KioskController::class, 'checkout'])->name('kiosk.checkout');
    Route::get('/kiosk/checkin', [KioskController::class, 'checkin'])->name('kiosk.checkin');
    Route::get('/kiosk/scan', [KioskController::class, 'scan'])->name('kiosk.scan');
});

// Include your custom auth routes
require __DIR__.'/auth.php';
