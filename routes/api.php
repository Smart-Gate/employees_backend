<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// company APIs
Route::get('company', [CompanyController::class,'index']);
Route::get('company/{id}', [CompanyController::class,'show']);
Route::post('company', [CompanyController::class,'store']);
Route::post('company/{id}', [CompanyController::class,'update']);
Route::delete('company/{id}', [CompanyController::class,'destroy']);

//employee APIs
Route::get('employee', [EmployeeController::class,'index']);
Route::get('employee/{id}', [EmployeeController::class,'show']);
Route::post('employee', [EmployeeController::class,'store']);
Route::post('employee/{id}', [EmployeeController::class,'update']);
Route::delete('employee/{id}', [EmployeeController::class,'destroy']);




