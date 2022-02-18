<?php

use App\Http\Controllers\Api\V1\CommunityLinkController;
use App\Http\Controllers\Api\V1\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Con este método accedemos a todos los métodos de CommunityLinkController. 

Route::apiResource('v1/communityLinks', CommunityLinkController::class)->middleware('api');

Route::post('v1/communityLinks/login', [LoginController::class, 'login']);
