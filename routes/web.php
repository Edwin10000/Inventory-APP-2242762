<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/products', [ProductController::class , "show"]);

Route::get('/product/delete/{id}', [ProductController::class , "delete"])->name('product.delete');

Route::get('/product/form/{id?}', [ProductController::class , "form"])->name('product.form');

Route::post('/product/save', [ProductController::class , "save"])->name('product.save');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\BrandController;

Route::get('/brands' , [BrandController::class , "show"]);

Route::get('/brand/delete/{id}',[BrandController::class, 'delete'])->name('brand.delete');

Route::get('/brand/formBrand/{id?}', [BrandController::class, 'form'])->name('brand.formBrand');

Route::post('/brand/saveBrand', [BrandController::class, 'save'])->name('brand.saveBrand');

use App\Http\Controllers\CategorieController;

Route::get('/categories' , [CategorieController::class , "show"]);

Route::get('/categorie/delete/{id}',[CategorieController::class, 'delete'])->name('categorie.delete');

Route::get('/categorie/formCategorie/{id?}', [CategorieController::class, 'form'])->name('categorie.formCategorie');

Route::post('/categorie/saveCategorie', [CategorieController::class, 'save'])->name('categorie.saveCategorie');
