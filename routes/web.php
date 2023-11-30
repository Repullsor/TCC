<?php

use App\Http\Controllers\BloodPressureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DiabetesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('dashboard.index');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('dashboard', DashboardController::class);
    
    Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit/{id}', [UserController::class, 'edit'])->name('profile.edit');
    // Route::post('/profile/update/{id}', [UserController::class, 'update'])->name('profile.update'); //assim deu o problema pra resolver tem que ser assim: 
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update'); // assim tambem funcionou depois que comentei a linha de cima
    
    Route::resource('diabetes', DiabetesController::class);
    Route::resource('pressure', BloodPressureController::class);
    Route::get('/diabetes', [DiabetesController::class, 'index'])->name('diabetes.index');
    Route::delete('/diabetes/{diabetes}', [DiabetesController::class, 'destroy'])->name('diabetes.destroy');
    Route::post('/diabetes/import', [DiabetesController::class, 'import'])->name('diabetes.import');
    Route::get('/pressure', [BloodPressureController::class, 'index'])->name('pressure.index');
    Route::delete('/blood-pressure/{bloodPressure}', [BloodPressureController::class, 'destroy'])->name('pressure.destroy');
    Route::post('/pressure/import', [BloodPressureController::class, 'import'])->name('pressure.import');

    Route::resource('device', DeviceController::class);
    Route::get('/device', [DeviceController::class, 'index'])->name('device.index');
    Route::get('/device/create', [DeviceController::class, 'create'])->name('device.create');
    Route::delete('/device/{id}', [DeviceController::class, 'destroy'])->name('device.destroy');
    Route::get('/device/{id}/edit', [DeviceController::class, 'edit'])->name('device.edit');
    Route::put('/device/{id}', [DeviceController::class, 'update'])->name('device.update');
    
});

Auth::routes();
