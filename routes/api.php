<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\SkillsController;
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

Route::middleware('auth:sanctum')->group(function (){

});

Route::post('/auth/login', [AuthenticationController::class, 'login']);

Route::post('/candidate/store', [CandidatesController::class, 'store']);
Route::get('/get-jabatan', [JobsController::class, 'index']);
Route::get('/get-skill', [SkillsController::class, 'index']);
Route::get('/get-tahun', [JobsController::class, 'year']);
