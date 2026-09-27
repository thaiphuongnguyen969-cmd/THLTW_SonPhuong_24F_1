<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

// Tự động sinh ra các route CRUD (index, store, show, update, destroy)
Route::apiResource('categories', CategoryController::class);

