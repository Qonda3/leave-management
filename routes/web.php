<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Leave\LeaveRequestController;
use Illuminate\Support\Facades\Route;

/**
 * Redirect users to the login page
 * when accessing the application root.
 */
Route::get('/', function () {
    return redirect()->route('login');
});

/**
 * Protected routes accessible only
 * to authenticated and verified users.
 */
Route::middleware(['auth', 'verified'])->group(function () {

    //Display the user's dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Leave request management routes.
     * 
     * Allow users to view, create,
     * submit, and inspect leave requests.
     */
    Route::prefix('leaves')->name('leaves.')->group(function () {
        Route::get('/', [LeaveRequestController::class, 'index'])->name('index');
        Route::get('/create', [LeaveRequestController::class, 'create'])->name('create');
        Route::post('/', [LeaveRequestController::class, 'store'])->name('store');
        Route::get('/{leaveRequest}', [LeaveRequestController::class, 'show'])->name('show');
    });

});

require __DIR__.'/auth.php';
