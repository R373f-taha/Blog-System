<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::group(['prefix'=>'blogs','as'=>'blogs.'],function () {
Route::get('/show',[BlogController::class,'index'])->name('showAll');
Route::get('/show/{blog}',[BlogController::class,'show'])->name('show');
Route::post('blog/{id}/favorite',[BlogController::class,'toggleFav'])->name('manage_favorite');
Route::get('blog/favorites',[BlogController::class,'favoritesBlog'])->name('favorite_blogs');
});

Route::group(['prefix'=>'blogs','as'=>'blogs.'],function () {
Route::get('/create',[BlogController::class,'create'])->name('create');
Route::post('/store',[BlogController::class,'store'])->name('store');
Route::get('/edit/{blog}',[BlogController::class,'edit'])->name('edit');
Route::put('/update/{blog}',[BlogController::class,'update'])->name('update');
Route::delete('/delete/{blog}',[BlogController::class,'softDelete'])->name('softDelete');
Route::get('/trashed',[BlogController::class,'trash'])->name('Trashed');
Route::delete('/force-delete/{id}',[BlogController::class,'forceDelete'])->name('forceDelete');
Route::get('/restore/{id}',[BlogController::class,'restore'])->name('restore');
})->middleware('admin');

//categories
Route::group(['prefix'=>'categories','as'=>'categories.'],function () {
Route::get('/show',[CategoryController::class,'index'])->name('showAll');
Route::get('/create',[CategoryController::class,'create'])->name('create');
Route::get('/show/{category}',[CategoryController::class,'show'])->name('show');
Route::post('/store',[CategoryController::class,'store'])->name('store');
Route::get('/edit/{category}',[CategoryController::class,'edit'])->name('edit');
Route::put('/update/{category}',[CategoryController::class,'update'])->name('update');
Route::delete('/delete/{category}',[CategoryController::class,'destroy'])->name('delete');
//Route::get('/categories/{blog_id}',[CategoryController::class,'categories'])->name('categories');

});

Route::group(['prefix'=>'categories','as'=>'categories.'],function () {


Route::post('/store',[CategoryController::class,'store'])->name('store');
Route::get('/edit/{category}',[CategoryController::class,'edit'])->name('edit');
Route::put('/update/{category}',[CategoryController::class,'update'])->name('update');
Route::delete('/delete/{category}',[CategoryController::class,'destroy'])->name('delete');
//Route::get('/categories/{blog_id}',[CategoryController::class,'categories'])->name('categories');

})->middleware('admin');
require __DIR__.'/auth.php';
