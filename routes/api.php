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

Route::group(['middleware' => 'auth:sanctum'],function (){
    Route::group(['prefix' => 'auth'], function(){
        Route::post('/me', [AuthenticationController::class, 'me']);
        Route::post('/logout', [AuthenticationController::class, 'logout']);
    });
    Route::group(['prefix'=> 'master'], function (){
        Route::group(['prefix'=> 'skill'], function (){
            Route::get('/', [SkillsController::class, 'get_all_skill']);
            Route::post('/', [SkillsController::class, 'store']);
            Route::put('/{id}', [SkillsController::class, 'update']);
            Route::delete('/{id}', [SkillsController::class, 'destroy']);
        });
        Route::group(['prefix'=> 'jobs'], function (){
            Route::get('/', [JobsController::class, 'get_all_jobs']);
            Route::post('/', [JobsController::class, 'store']);
            Route::put('/{id}', [JobsController::class, 'update']);
            Route::delete('/{id}', [JobsController::class, 'destroy']);
        });
    });
    Route::group(['prefix'=>'candidate'], function (){
        Route::get('/', [CandidatesController::class, 'get_all_candidate']);
        Route::put('/{id}', [CandidatesController::class, 'update_status']);
    });
});

Route::post('/auth/login', [AuthenticationController::class, 'login']);

Route::post('/candidate/store', [CandidatesController::class, 'store']);
Route::get('/get-jabatan', [JobsController::class, 'index']);
Route::get('/get-skill', [SkillsController::class, 'index']);
Route::get('/get-tahun', [JobsController::class, 'year']);
