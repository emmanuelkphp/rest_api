<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentsController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('students', [StudentsController::class, 'index']);
Route::post('students/create', [StudentsController::class, 'store']);
Route::get('students/{id}', [StudentsController::class, 'show']);
Route::post('students/edit/{id}', [StudentsController::class, 'update']);
Route::delete('students/{id}', [StudentsController::class, 'destroy']);



