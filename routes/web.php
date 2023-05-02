<?php

use App\Http\Controllers\EmployeeController;
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


Route::post('/getlist', [EmployeeController::class, 'Getlist'])->name('getlist');

Route::get('emp/{id?}',[EmployeeController::class, 'load']);

Route::get('/index', [EmployeeController::class, 'index']);

Route::post('/store/{id?}', [EmployeeController::class, 'store'])->name('Store');

Route::delete('Delete', [EmployeeController::class, 'delete'])->name('Delete');
