<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TypeController;

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

Route::middleware('auth:sanctum')->group(function () {
   Route::get('/user', [UserController::class, 'user']);
   Route::post('/logout', [AuthController::class, 'logout']);
});

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Companies
Route::apiResource('companies', CompanyController::class);
Route::get('/five-last/companies', [CompanyController::class, 'getFiveLast']);

// Invoices
Route::apiResource('invoices', InvoiceController::class);
Route::get('/five-last/invoices', [InvoiceController::class, 'getFiveLast']);
Route::get('/five-last/invoices/{id}', [InvoiceController::class, 'getFiveLastByCompany']);

// Contacts
Route::apiResource('contacts', ContactController::class);
Route::get('/five-last/contacts', [ContactController::class, 'getFiveLast']);
Route::get('/contacts/company/{id}', [ContactController::class, 'getContactByCompanyId']);
// Users
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

// Types
Route::apiResource('types', TypeController::class);

