<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommunityLinkController;
use App\Http\Controllers\CommunityLinkUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => 'true']);

Route::group(['middleware' => 'verified'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('community', [CommunityLinkController::class, 'index']);
    Route::post('community', [CommunityLinkController::class, 'store']);
});

Route::get('/community/{channel}', [CommunityLinkController::class, 'index']);

// Ruta para votar un link 

Route::post('/votes/{link_id}', [CommunityLinkUserController::class, 'store']);
