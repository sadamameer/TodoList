<?php

use App\Http\Controllers\TodoController;
use App\Http\Middleware\TasksMiddlware;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [TodoController::class, "index"])->name("index");
Route::get('/create', [TodoController::class, "createTaskView"])->name("createTaskView");
Route::get('/edit/{id}', [TodoController::class, "editTaskView"])->name("editTaskView");
Route::post('/create-or-update', [TodoController::class, "createOrUpdate"])->name("createOrUpdate");
Route::get('/fetch-todos', [TodoController::class, "fetch"])->name("fetch");
Route::post('/change-status', [TodoController::class, "changeStatus"])->name("changeStatus");
Route::post('/delete', [TodoController::class, "deleteTask"])->name("deleteTask");