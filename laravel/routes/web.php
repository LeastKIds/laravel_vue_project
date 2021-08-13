<?php

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

Route::prefix('auth') -> group(function() {
    Route::get('user', [RegisterController::class, 'loginCheck']);
});
