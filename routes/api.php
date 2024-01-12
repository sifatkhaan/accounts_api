<?php

use App\Http\Controllers\AccountCon;
use App\Http\Controllers\ItemCon;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/parchase', [AccountCon::class, 'index']);
Route::post('/sales', [AccountCon::class, 'store']);
Route::get('/report', [AccountCon::class, 'report']);
Route::get('/item', [ItemCon::class, 'index']);
Route::post('/item', [ItemCon::class, 'store']);
Route::put('/item/{id}', [ItemCon::class, 'update']);