<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;



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


Route::post('/register',[ApiController::class,'postRegister']); 
Route::post('/login',[ApiController::class,'postLogin']);
Route::post('/edit-profile-page',[ApiController::class,'editProfilePage']);
Route::post('/edit-profile',[ApiController::class,'editProfile']);
Route::post('/delete-blog',[ApiController::class,'deleteBlog']);
Route::post('/edit-blog-page',[ApiController::class,'editBlogPage']);
Route::post('/edit-blog',[ApiController::class,'editBlog']);
Route::post('/create-blog',[ApiController::class,'createBlog']);
Route::post('/change-status',[ApiController::class,'updateUserStatus']);
// Route::post('/get-blog-data',[ApiController::class,'getBlogData']);
Route::post('/get-userblog-data',[ApiController::class,'getUserBlogData']);
Route::post('/get-users-data',[ApiController::class,'getUsersData']);
Route::post('/get-my-data',[ApiController::class,'getMyData']);

// Route::get('/all-blog-data',[ApiController::class,'getAllBlogData']);

Route::post('/all-blog-data',[ApiController::class,'getAllBlogData']);

Route::post('/create-category',[ApiController::class,'createCategory']);
Route::get('/all-category-data',[ApiController::class,'getAllCategoryData']);
Route::post('/get-blog-details',[ApiController::class,'getBlogDetails']);
Route::post('/category-blog',[ApiController::class,'getCategoryBlog']);

Route::post('/get-category-details',[ApiController::class,'getCategoryData']);
// Route::get('/get-all-user-data',[ApiController::class,'getAllUsersData']);
Route::post('/edit-category-page',[ApiController::class,'editCategoryPage']);
Route::post('/post-edit-category',[ApiController::class,'postEditCategory']);
Route::post('/change-category-status',[ApiController::class,'updateCategoryStatus']);
Route::post('/change-blog-status',[ApiController::class,'updateBlogStatus']);
