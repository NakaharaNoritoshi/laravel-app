<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

// お問い合わせのRoute
Route::get('contact', [ContactController::class, 'index'])->name('contact_front.index');
Route::post('contact/confirm', [ContactController::class, 'confirm'])->name('contact_front.confirm');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact_front.send');

Route::middleware('auth')->group(function () {
// お問い合わせ管理一覧のRoute
Route::get('contact/list', [ContactController::class, 'list'])->name('contact_back.list');
// お問い合わせ詳細のRoute
Route::get('contact/{id}', [ContactController::class, 'detail'])->whereNumber('id')->name('contact_back.detail');
// お問い合わせを削除するRoute
Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
