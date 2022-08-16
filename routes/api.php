<?php

use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Route;

Route::apiResource('meals', MealController::class);
