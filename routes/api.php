<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TranslationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->group(function () {
//         Route::post('/translations', [TranslationController::class, 'store']);
//         Route::put('/translations/{id}', [TranslationController::class, 'update']);
//         Route::get('/translations', [TranslationController::class, 'index']);
//         Route::get('/translations/export', [TranslationController::class, 'export']);
// });

// Route::get('/translations', [TranslationController::class, 'index']);
// Route::get('/export-translations', [TranslationController::class, 'export']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/translations', [TranslationController::class, 'index']);
    Route::post('/translations', [TranslationController::class, 'store']);
    Route::put('/translations/{translation}', [TranslationController::class, 'update']);
    Route::delete('/translations/{translation}', [TranslationController::class, 'destroy']);
    Route::get('/translations/export/json', [TranslationController::class, 'exportJson']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/translations', [TranslationController::class, 'store']);
//     Route::put('/translations/{id}', [TranslationController::class, 'update']);
//     Route::get('/translations', [TranslationController::class, 'index']);
//     Route::get('/translations/export', [TranslationController::class, 'export']);
// });
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);