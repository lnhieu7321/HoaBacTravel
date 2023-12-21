<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('business.auth.login');
});

Route::get('/dashboard', function () {
    return view('business.home.dashboard');
    Route::get('/dashboardhome',  [App\Http\Controllers\BookingController::class, 'dashboard']);
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



// ----------------------------- booking -----------------------------//
Route::get('/allbooking', [App\Http\Controllers\BookingController::class, 'allbooking'])->middleware('auth')->name('form/allbooking');
Route::get('form/booking/edit', [App\Http\Controllers\BookingController::class, 'bookingEdit']);

Route::post('form/booking/save', [App\Http\Controllers\BookingController::class, 'saveRecord'])->middleware('auth')->name('form/booking/save');
Route::post('form/booking/update', [App\Http\Controllers\BookingController::class, 'updateRecord'])->middleware('auth')->name('form/booking/update');
Route::post('/delete', [App\Http\Controllers\BookingController::class, 'deleteRecord'])->middleware('auth')->name('form/booking/delete');
Route::get('/approveBooking/{id}', [App\Http\Controllers\BookingController::class, 'approveBooking'])->middleware('auth')->name('form/booking/approveBooking');
Route::get('/cancelBooking/{id}', [App\Http\Controllers\BookingController::class, 'cancelBooking'])->middleware('auth')->name('form/booking/cancelBooking');


// ----------------------------- service -----------------------------//
Route::get('/allservice', [App\Http\Controllers\ServiceController::class, 'allservice'])->middleware('auth')->name('form/allservice');
Route::get('/serviceedit/{id}', [App\Http\Controllers\ServiceController::class, 'serviceEdit'])->middleware('auth')->name('form/serviceedit');
Route::get('/serviceadd', [App\Http\Controllers\ServiceController::class, 'serviceAdd'])->middleware('auth')->name('form/serviceadd');

Route::post('/service/save', [App\Http\Controllers\ServiceController::class, 'saveRecord'])->middleware('auth')->name('form/service/save');
Route::post('/service/update', [App\Http\Controllers\ServiceController::class, 'updateRecord'])->middleware('auth')->name('form/service/update');
Route::post('/servicedelete', [App\Http\Controllers\ServiceController::class, 'deleteRecord'])->middleware('auth')->name('form/service/delete');









//==================================================admin===============================================//