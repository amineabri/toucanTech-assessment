<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
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

Route::get('/', [HomeController::class, "index"])->name('home'); // List
Route::get('/member/save', [MemberController::class, "storeForm"])->name('member.save.form');
Route::get('/member/list', [MemberController::class, "list"])->name('member.list');
Route::post('/member/save', [MemberController::class, "store"])->name('member.save');
Route::get('/download/csv', [MemberController::class, "download"])->name('download.csv');
Route::get('/analysis', [HomeController::class, "analysis"])->name('analysis');
