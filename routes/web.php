<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;



Route::get('/login',  [Controller::class, 'getLogin']);
Route::post('/login', [Controller::class, 'login'])->name('login');
Route::post('/logout', [Controller::class, 'logout'])->name('logout');

Route::redirect('/', '/dashboard', 302);
Route::get("/dashboard", [Controller::class, "getDashboard"]);
Route::get("/report", [Controller::class, "getReport"]);

Route::post("/upsert", [RestController::class, "upsertItems"])->middleware("auth");
Route::post("/delete", [RestController::class, "deleteItems"])->middleware("auth");
