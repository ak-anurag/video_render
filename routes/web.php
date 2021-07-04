<?php
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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'showIndex']);
Route::get('/videos', [\App\Http\Controllers\IndexController::class, 'showCityVideo'])->name('city_video');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('video_upload');

Route::get('/setting', [App\Http\Controllers\SettingController::class, 'showSetting'])->name('setting');
Route::post('/change-password', [\App\Http\Controllers\SettingController::class, 'changePassword'])->name('change_password');
Route::post('/change-city', [\App\Http\Controllers\SettingController::class, 'changeCity'])->name('change_city');
Route::get('/specific-video', [\App\Http\Controllers\IndexController::class, 'showSpecificVideo'])->name('specific_video');

Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'saveComment'])->name('comment');