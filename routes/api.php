<?php

use App\Http\Controllers\IncomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('add-income', [IncomeController::class, 'addIncome']);
Route::get('get-income', [IncomeController::class, 'getIncome']);
