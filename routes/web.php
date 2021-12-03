<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/file', [ProductController::class,'files']);
    Route::post('/save-file', [ProductController::class,'saveFile'])->name('save.file');
});
Route::get('/gg', function ()
{
    Artisan::call('migrate:refresh',['--force'=>true]);
    Artisan::call('db:seed');
});
Route::get('/loader', function ()
{
    return Inertia::render('Loader');
});
Route::get('/showimg', function ()
{
    return Inertia::render('ShowImage');
});
Route::get('/multipleFiles', function ()
{
    return Inertia::render('MultipleFiles');
});


Route::get('/pagination', function ()
{
    return Inertia::render('Pagination');
});
Route::get('/dataUsers', function ()
{
    return User::paginate(10);
});



Route::resource('products', ProductController::class)->middleware(['auth:sanctum', 'verified']);