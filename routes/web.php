<?php

use App\Http\Controllers\AdminController;
use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;


Route::get('/', function () {
    return view('home', [
        "title" => "Home",
    ]);
})->middleware('auth');;

Route::get('/posts', [PostController::class, 'index'])->middleware('auth');
//jika hanya menulis post, tetap akan mengirim id sebagai unique identifier
Route::get('posts/{post:slug}', [PostController::class, 'show'])->middleware('auth');

//masukin category ke dalam controller
Route::get('/categories', function() {
    return view('categories', [ //closure
        'title' => 'Post Categories',
        'categories' => Category::all()
    ]);
})->middleware('auth');

//ada request login method get, jalanin middleware, lanjut ke class logincontroller | ada name route
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']); //store
Route::post('/logout', [LoginController::class, 'logout']); 

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');

//Misal ada request yang methodnya post maka panggil controller register yang methodnya store
Route::post('/register', [RegisterController::class, 'store']);

//ketika ada request dengan method get ke url /dashboard/....
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

//Route model binding karena memakai resource
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
Route::resource('/dashboard/admin', AdminController::class);
