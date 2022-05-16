<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageUploadController;
/*
|--------------------------------------------------------------------------
| Web Routes for project
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Concernant l'utilisateur //
Route::resource('/user', App\Http\Controllers\UserController::class)->except('store', 'create', 'destroy');

// Concernant les pomgos //

Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');

Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');

Route::resource('/pomgo', App\Http\Controllers\PomgoController::class);

Route::get('/search', [App\Http\Controllers\PomgoController::class, 'search']);


// Concernant les commentaires //

Route::resource('/comment', App\Http\Controllers\CommentController::class);

