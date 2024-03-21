<?php

use App\Http\Controllers\CandidatesController;
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
$subpath_domain = config('myconfig.SUBPATH_DOMAIN');
Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('/apply', CandidatesController::class);

Route::any('{all}', function () {
    if(str_contains(Request::url(),'admin')){
        return view('admin');  
    }else{
        return view('welcome');  
    }        
})->where('all', '^(?!api).*$');
