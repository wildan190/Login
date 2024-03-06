<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\SuperAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('superadmin')->middleware(['auth', 'checkRole:superadmin'])->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::patch('/update-user-roles', [SuperAdminController::class, 'updateUserRoles'])->name('superadmin.updateUserRoles');
});

Route::middleware(['checkRole:admin,superadmin'])->group(function () {
    // Routes yang memerlukan admin atau superadmin role
});

Route::middleware(['checkRole:user,admin,superadmin'])->group(function () {
    // Routes yang memerlukan user, admin, atau superadmin role
});


require __DIR__.'/auth.php';
