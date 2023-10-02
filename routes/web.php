<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;

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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/demo/{name}/{id?}', function($name, $id = null){
    // return view('demo');
    // $data = compact('name','id');
    // return view('demo')->with($data);
    // print_r($data);
    // echo $name . "  ";
    // echo $id;
// });
Route::get('/home',function(){
    return view('home');
});
Route::get('/demo',function(){
    return view('demo');
});
Route::get('/demo1',function(){
    return view('demo1');
});
Route::resource('photo',PhotoController::class);
Route::get('/tst',[DemoController::class,'index']);





Route::get('/signup',[DemoController::class,'getSignup']);
Route::post('/signup',[DemoController::class,'postSignup']);

Route::get('/signin',[DemoController::class,'getSignin']);
Route::post('/signin',[DemoController::class,'postSignin']);

Route::get('/logout',[DemoController::class,'getLogout'])->name('logout');
// Route::get('/admin/logout',[DemoController::class,'getLogout'])->name('adminLogout');


Route::get('/my-account',[DemoController::class,'myAccount'])->middleware('signintest');
Route::get('/edit/{id}',[DemoController::class,'editProfile'])->name('editProfile')->middleware('signintest');
Route::post('/profile-edit/{id}',[DemoController::class,'postEditProfile'])->name('postEditProfile'); 

Route::post('/delete-blog',[BlogController::class,'deleteBlog'])->name('deleteBlog');

Route::get('/blog',[BlogController::class,'createBlog'])->name('createBlog')->middleware('signintest');
Route::post('/postBlog',[BlogController::class,'postCreatedBlog'])->name('postCreatedBlog');
Route::get('/all-blog',[BlogController::class,'allBlog'])->middleware('signintest');

Route::get('/blog-list',[BlogController::class,'userBlog'])->middleware('signintest');
Route::get('/admin/blog-list',[BlogController::class,'userBlog'])->middleware('signintest');

Route::get('/edit-blog/{id}',[BlogController::class,'editBlog'])->name('editBlog')->middleware('signintest');
Route::post('/blog-edit/{id}',[BlogController::class,'postEditBlog'])->name('postEditBlog');

Route::get('/admin/myaccount',[DemoController::class,'myAccount'])->middleware('signintest');

Route::post('/admin/change-status',[DemoController::class,'postChangeStatus'])->name('updateStatus');
Route::get('/admin/user-blog/{id}',[BlogController::class,'userBlog'])->middleware('signintest')->middleware('signintest');
Route::get('/admin-edit-blog/{id}',[BlogController::class,'adminEditBlog'])->name('adminEditBlog')->middleware('signintest');
Route::post('/post-adminedit-blog/{id}',[BlogController::class,'postAdminEditBlog'])->name('postAdminEditBlog');

Route::get("/news-blog",[DemoController::class,'newsBlog']);
Route::get("//about-info",[DemoController::class,'aboutPage']);
Route::get("/contact-info",[DemoController::class,'contactPage']);
Route::get("/",[DemoController::class,'newsBlog']);

Route::get("/blog/{slug}",[BlogController::class,'readBlog']);

Route::post('/admin/change-blog',[BlogController::class,'updateBlogStatus'])->name('updateBlogStatus');

Route::post('/admin/change-category',[CategoryController::class,'changeCategoryStatus'])->name('changeCategoryStatus');

Route::get("/category",[CategoryController::class,'createCategory']);
Route::post('/post-create-category',[CategoryController::class,'postCreateCategory']);
Route::get('/admin/category-list',[CategoryController::class,'categoryListing']);
Route::get('/user/category-list',[CategoryController::class,'categoryListing']);
Route::get('/edit-category/{id}',[CategoryController::class,'editCategory']);
Route::post('/post-edit-category/{id}',[CategoryController::class,'postEditCategory']);




