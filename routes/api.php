<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::post('/insertUser', [ReviewersController::class, 'insertUser']);
Route::post('/deleteUser', [ReviewersController::class, 'deleteUser']);

Route::post('/insertMovie', [MoviesController::class, 'insertMovie']);
Route::post('/deleteMovie', [MoviesController::class, 'deleteMovie']);

Route::post('/createReview', [ReviewsController::class, 'createReview']);
Route::post('/deleteReview', [ReviewsController::class, 'deleteReview']);

Route::get('/getAllUsers', [ReviewersController::class, 'getAllUsers']);
Route::get('/getAllMovies', [MoviesController::class, 'getAllMovies']);
Route::get('/getAllReviews', [ReviewsController::class, 'getAllReviews']);

Route::get('/getUser', [ReviewersController::class, 'getUser']);
Route::get('/getMovie', [MoviesController::class, 'getMovie']);
Route::get('/getReview', [ReviewsController::class, 'getReview']);

Route::get('/getAverageRatingMovie', [ReviewsController::class, 'getAverageRatingMovie']);
Route::get('/getAverageRatingUser', [ReviewsController::class, 'getAverageRatingUser']);
