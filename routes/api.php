<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//

// Route::post('/tasks',[TaskController::class,'store']);  // Create

// Route::put('/tasks/{id}',[TaskController::class,'update']); // Update

// Route::get('/tasks/{id}',[TaskController::class,'show']); // Show or Search

// Route::delete('/tasks/{id}',[TaskController::class,'delete']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/tasks',TaskController::class); // All-in-one

    Route::get('/task/all',[TaskController::class,'getAllTasks'])->middleware('CheckUser'); // Read

    Route::get('/task/ordered',[TaskController::class,'getTaskBypriority']);

    // profile
    Route::prefix('profile')->group(function () {
        Route::get('/',[ProfileController::class,'index']);

        Route::post('/',[ProfileController::class,'store']);

        Route::get('/{id}',[ProfileController::class,'show']);

        Route::post('/{id}',[ProfileController::class,'update']);

        Route::post('/{id}',[ProfileController::class,'destroy']);
    });


    // Route::apiResource('/profile',TaskController::class)->middleware('auth:sanctum'); // All-in-one

    Route::get('user/{id}/profile',[UserController::class,'getProfile']);


    Route::get('user/{id}/tasks',[UserController::class,'getUserTasks']);

    Route::get('/user/get',[UserController::class,'GetUser']);

    Route::get('/user/all',[UserController::class,'GetAllUser'])->middleware('CheckUser');

    Route::get('task/{id}/user',[TaskController::class,'getTaskForUser']);

    Route::get('tasks/{task_id}/categories',[TaskController::class,'AddCategoriesToTasks']);

    // category Routes
    // Route::get('/category',[CategoryController::class,'index']);

    // Route::post('/category',[CategoryController::class,'store']);

    Route::apiResource('/category',CategoryController::class)->middleware('auth:sanctum'); // All-in-one

    Route::get('/task/{taskId}/categories',[TaskController::class,'getTaskCategories']);

    Route::get('/categories/{taskId}/tasks',[TaskController::class,'getCategoriesTask']);

    // favorites
    Route::post('/task/{taskId}/favorite',[TaskController::class,'addToFavorite']);

    Route::delete('/task/{taskId}/favorite',[TaskController::class,'removeFromFavorite']);

    Route::get('/task/favorite',[TaskController::class,'getFavoriteTask']);
});

// users
Route::post('/register',[UserController::class,'register']);

Route::post('/login',[UserController::class,'login']);

Route::post('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');

Route::get('/log',function(){
    Log::info('My First Log Test');
});
