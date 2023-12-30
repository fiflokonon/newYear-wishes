<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\MessageController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('pages.home_first');
});

Route::get('/error-404', function () {
    return view('partials.error-404');
})->name('not_found');

Route::get('/message', function () {
    return view('pages.message');
});

Route::get('/messages/{link}', [MessageController::class, 'getMessageByLink'])->name('message');
Route::get('/messages/{id}/link', [MessageController::class, 'messageLink'])->name('message_link');
Route::post('/new-message', [MessageController::class, 'new_message'])->name('new_message');
Route::post('/add-answer', [AnswerController::class, 'addAnswer'])->name('add_answer');
