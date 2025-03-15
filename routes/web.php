<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RestController;



Route::get('/login',  [Controller::class, 'getLogin']);
Route::get('/signup', [Controller::class, 'getSignup']);
Route::post('/login', [Controller::class, 'login'])->name('login');
Route::post('/signup', [Controller::class, 'signup'])->name('signup');
Route::post('/logout', [Controller::class, 'logout'])->name('logout');

Route::redirect('/', '/dashboard', 302)->middleware("auth");
Route::get("/dashboard", [Controller::class, "getDashboard"])->middleware("auth");
Route::get("/report", [Controller::class, "getReport"])->middleware("auth");

Route::post("/upsert", [RestController::class, "upsertItems"])->middleware("auth");
Route::post("/delete", [RestController::class, "deleteItems"])->middleware("auth");
Route::post("/upsertCategory", [RestController::class, "upsertCategory"])->middleware("auth");
Route::post("/deleteCategory", [RestController::class, "deleteCategory"])->middleware("auth");
