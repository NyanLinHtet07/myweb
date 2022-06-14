<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});




Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    }) -> name('dashboard');

  
    
    //for blog

    Route::get('/blog', [BlogController::class,'index']) -> name('blog.index');
    Route::post('/blog', [BlogController::class, 'store']);
    Route::put('/blog/{id}' , [BlogController::class, 'update']);
    Route::delete('/blog/{id}' , [BlogController::class, 'destroy']);

    //for tag
    Route::get('/tag' ,[TagController::class, 'index']) -> name('tag.index');
    Route::post('/tag',[TagController::class,'store']);
    Route::put('/tag/{id}' , [TagController::class, 'update']);
    Route::delete('/tag/{id}', [TagController::class, 'destroy']);

    //for project
    Route::get('/project', [ProjectController::class, 'index']) -> name('project.index');
    Route::post('/project', [ProjectController::class, 'store']);
    Route::put('/project/{id}', [ProjectController::class, 'update']);
    Route::delete('/project/{id}', [ProjectController::class, 'destroy']);
 

  
});


require __DIR__.'/auth.php';
