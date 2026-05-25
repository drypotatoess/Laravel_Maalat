<?php
 
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
 
Route::get('/', function () {
    return view('welcome');
});
 
// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
 
// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
 
// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 
// DASHBOARD (placeholder — palitan mo mamaya)
Route::get('/dashboard', function () {
    return 'Dashboard - coming soon!';
})->name('dashboard');