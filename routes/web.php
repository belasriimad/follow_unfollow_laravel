<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

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

Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        $users = User::all();
        return view('home')->with([
            'users' => $users
        ]);
    });
    Route::post('user/logout', [UserController::class, 'logout'])
    ->name('logout');
});

Route::get('user/register', [UserController::class, 'registerForm'])
    ->name('register');

Route::post('user/register', [UserController::class, 'store'])
    ->name('register');

Route::get('user/login', [UserController::class, 'loginForm'])
    ->name('login');

Route::post('user/login', [UserController::class, 'auth'])
    ->name('login');

Route::get('user/{following_id}/{follower_id}/follow', [UserController::class, 'follow'])->name('follow');
Route::get('user/{following_id}/{follower_id}/unfollow', [UserController::class, 'unfollow'])->name('unfollow');