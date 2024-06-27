<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/login');
});

// Ruta para registrar los productos
Route::get('/register', function(){
    return Inertia::render('Auth/Register');
})->middleware('auth:sanctum');


// categoria
Route::name('category.')->controller(CategoryController::class)
    ->prefix('category')
    ->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::patch('/{code}','update')->name('update');
        Route::patch('/delete/{code}','destroy')->name('destroy');
        Route::get('/get','get')->name('get');
    });


// Productos
Route::name('product.')->controller(ProductController::class)
    ->prefix('product')
    ->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::patch('/{product}','update')->name('update');
        Route::patch('/delete/{product}','destroy')->name('destroy');
    });



// Rutas de las ventas
Route::name('sale.')->controller(SaleController::class)
    ->prefix('sale')
    ->group(function(){
        Route::get('/','index')->name('index');
    });


Route::middleware([
    'auth:sanctum'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
