<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('add-income', [IncomeController::class, 'addIncome']);
Route::get('get-income', [IncomeController::class, 'getIncome']);
Route::post('delete-income', [IncomeController::class, 'deleteIncome']);
Route::post('update-income', [IncomeController::class, 'updateIncome']);

Route::post('add-expense', [ExpenseController::class, 'addExpense']);
Route::get('get-expense', [ExpenseController::class, 'getExpense']);
Route::post('delete-expense', [ExpenseController::class, 'deleteExpense']);
