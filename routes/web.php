<?php

use Illuminate\Support\Facades\Route;
use App\Events\newMessage;
use App\Events\chooseFriend;

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/send-message',[App\Http\Controllers\HomeController::class, 'sendMsg'])->name('sendMsg');
Route::post('/choose-friend',[App\Http\Controllers\HomeController::class, 'chooseFri'])->name('chooseFri');