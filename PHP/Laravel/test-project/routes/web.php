<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Routing\Controllers\Middleware;

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


Route::get('/test', [TestController::class, 'test'])
    ->name('test');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'role'])->group(function () {
Route::get('post', [PostController::class, 'index'])
    ->name('post.index');

Route::get('/post/create', [PostController::class, 'create']);
// });
//　新規投稿用のルート 
Route::post('post', [PostController::class, 'store'])
    ->name('post.store');

// 詳細記事表示用のルート
Route::get('post/{post}', [PostController::class, 'show'])
    ->name('post.show');
// 編集
Route::get('post/{post}/edit', [PostController::class, 'edit'])
    ->name('post.edit');
// 更新
Route::patch('post/{post}', [PostController::class, 'update'])
    ->name('post.update');
// 削除
Route::delete('post/{post}', [PostController::class, 'destroy'])
    ->name('post.destroy');


require __DIR__ . '/auth.php';
