<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;

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

Route::post('/register', [UserController::class, 'register']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::post('/insertUser', [ReviewersController::class, 'insertUser'])->middleware(EnsureTokenIsValid::class);
Route::post('/deleteUser', [ReviewersController::class, 'deleteUser'])->middleware(EnsureTokenIsValid::class);

Route::post('/insertMovie', [MoviesController::class, 'insertMovie'])->middleware(EnsureTokenIsValid::class);
Route::post('/deleteMovie', [MoviesController::class, 'deleteMovie'])->middleware(EnsureTokenIsValid::class);

Route::post('/createReview', [ReviewsController::class, 'createReview'])->middleware(EnsureTokenIsValid::class);
Route::post('/deleteReview', [ReviewsController::class, 'deleteReview'])->middleware(EnsureTokenIsValid::class);

Route::get('/getAllUsers', [ReviewersController::class, 'getAllUsers'])->middleware(EnsureTokenIsValid::class);
Route::get('/getAllMovies', [MoviesController::class, 'getAllMovies'])->middleware(EnsureTokenIsValid::class);
Route::get('/getAllReviews', [ReviewsController::class, 'getAllReviews'])->middleware(EnsureTokenIsValid::class);

Route::get('/getUser', [ReviewersController::class, 'getUser'])->middleware(EnsureTokenIsValid::class);
Route::get('/getMovie', [MoviesController::class, 'getMovie'])->middleware(EnsureTokenIsValid::class);
Route::get('/getReview', [ReviewsController::class, 'getReview'])->middleware(EnsureTokenIsValid::class);

Route::get('/getAverageRatingMovie', [ReviewsController::class, 'getAverageRatingMovie'])->middleware(EnsureTokenIsValid::class);
Route::get('/getAverageRatingUser', [ReviewsController::class, 'getAverageRatingUser'])->middleware(EnsureTokenIsValid::class);
