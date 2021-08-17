<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

//Route::middleware(['cors'])->group(function(){
//    Route::get('/csrf_token', function(){
//        return csrf_token();
//    });
//
//
//
//    // 여기에 라우터를 쓰면 됨
//});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/logout', [RegisterController::class, 'logout']);

Route::prefix('auth') -> group(function() {
    Route::get('user', [RegisterController::class, 'loginCheck']);
});

Route::prefix('post') -> group(function() {
    Route::post('/store', [PostController::class, 'store']);
    Route::get('/show/{id}', [PostController::class, 'show']);
    Route::get('/index', [PostController::class, 'index']);
    Route::post('/edit/{id}', [PostController::class, 'edit']);
    Route::delete('/delete/{id}', [PostController::class, 'delete']);
    Route::get('/search/{word}', [PostController::class, 'search']);
});
