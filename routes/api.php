<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public routes

/** Route Sing (in / up) */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/** Route Public Products */
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/search/{product}', [ProductController::class, 'search']);


//Protcted route
Route::prefix('products')->group(
    function () {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            //For Products
            Route::delete('/{id}', [ProductController::class, 'destroy']);
            Route::put('/{id}', [ProductController::class, 'update']);
            Route::post('/creat', [ProductController::class, 'store']);
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/{product}', [ProductController::class, 'show']);


            //For Comments
            Route::prefix("/{product}/comments")->group(function () {
                Route::post('/', [UserCommentController::class, 'store']);
                Route::put('/{id}', [UserCommentController::class, 'update']);
                Route::delete('/{user_comment}', [UserCommentController::class, 'destroy']);
            });



            //For Like
            Route::prefix("/{product}/likes")->group(function () {
                Route::post('/', [LikeController::class, 'store']);
            });



            //For Categories
            Route::prefix("categories")->group(function () {
                Route::get('/', [CategoryController::class, 'index']);
                Route::post('/', [CategoryController::class, 'store']);
                Route::get('/{category}', [CategoryController::class, 'show']);
                Route::put('/{category}', [CategoryController::class, 'update']);
                Route::delete('/{category}', [CategoryController::class, 'destroy']);
            });
        });
    }
);







//Route::get('/products', [ProductController::class, 'index']);
//Route::post('/products', [ProductController::class, 'store']);
