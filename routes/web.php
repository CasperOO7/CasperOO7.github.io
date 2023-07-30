<?php

use App\Models\Items; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UsersController;

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

Route::get('/',[ItemsController::class,'index']);

Route::get('/Items/create',[ItemsController::class,'create'])->middleware('auth');

Route::post('/Items',[ItemsController::class,'store'])->middleware('auth');

Route::get('/Items/{item}/edit',[ItemsController::class,'edit'])->middleware('auth');

Route::get('/Items/manage',[UsersController::class,'manage'])->middleware('auth');

Route::put('/Items/{item}',[ItemsController::class,'update'])->middleware('auth');

Route::delete('/Items/{item}',[ItemsController::class,'destroy'])->middleware('auth');

Route::get('/register',[UsersController::class,'create'])->middleware('guest');

Route::post('/users',[UsersController::class,'store']);

Route::post('/logout',[UsersController::class,'logout'])->middleware('auth');

Route::get('/login',[UsersController::class,'login'])->name('login')->middleware('guest');

Route::post('/users/authenticate',[UsersController::class,'authenticate']);



Route::get('/Items/{item}',[ItemsController::class,'show']);
