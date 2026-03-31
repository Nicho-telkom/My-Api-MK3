<?php

// Mengimpor class Request untuk mengambil data request (misalnya user login)
use Illuminate\Http\Request;

// Mengimpor Route untuk mendefinisikan endpoint API
use Illuminate\Support\Facades\Route;

// Mengimpor controller yang akan menangani logic
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;


// Route untuk register user baru (tidak perlu login)
Route::post('/register', [AuthController::class, 'register']);

// Route untuk login user (menghasilkan token)
Route::post('/login', [AuthController::class, 'login']);


// Group route yang dilindungi oleh middleware auth:sanctum
// Artinya hanya user yang sudah login (punya token) yang bisa akses
Route::middleware('auth:sanctum')->group(function () {

    // Route untuk logout (menghapus token user)
    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD untuk Category & Product menggunakan apiResource
    // Secara otomatis membuat route:
    // GET /categories → index (ambil semua data)
    // POST /categories → store (tambah data)
    // GET /categories/{id} → show (detail data)
    // PUT/PATCH /categories/{id} → update
    // DELETE /categories/{id} → destroy
    Route::apiResource('/categories', CategoryController::class);

    // Sama seperti categories, tapi untuk produk
    Route::apiResource('/products', ProductController::class);

    // Route untuk mengambil data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});