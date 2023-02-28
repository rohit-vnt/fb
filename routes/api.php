<?php

use App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return response()->json([
        'message' => 'please login first',
        'type'=>'failed'
    ],401);
})->name('login');
Route::post('/register', [Api::class, 'register']);
Route::post('/login', [Api::class, 'login']);
Route::post('/test', [Api::class, 'test']);

Route::middleware('auth:sanctum')->group(function () {
    //get methods
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/getCompanies',[Api::class,'getCompanies']);
    Route::get('/getBranch',[Api::class,'getBranch']);
    Route::get('/getUsers',[Api::class,'getUsers']);
    Route::get('/getSupplier',[Api::class,'getSupplier']);

    //post methods
    Route::post('/company', [Api::class, 'company']);
    Route::post('/branch', [Api::class, 'branch']);
    Route::post('/user', [Api::class, 'user']);
    Route::post('/supplier', [Api::class, 'supplier']);
});
