<?php

use App\Http\Controllers\ModelBackgroundController;
use App\Http\Controllers\ModelTagkategoriController;
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

Route::post('add-bg', [ModelBackgroundController::class, 'imgPost']);
Route::post('add-tag', [ModelTagkategoriController::class, 'store']);
Route::get('list-all-bg/{keyword}', [ModelBackgroundController::class, 'show']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
