<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ExpenseController extends Controller
{
    public function addExpense(Request $request): JsonResponse
    {
        try {
            $validatedExpenseDetails = $request->validate([
                'amount' => ['required', 'numeric', 'min:100'],
                'expense_category' => 'required|string',
            ]);

            Log::info($validatedExpenseDetails);

            // Create a new expense record
            Expense::create([
                'amount' => $validatedExpenseDetails['amount'],
                'expense_category' => $validatedExpenseDetails['expense_category'],
            ]);

            return response()->json([
                'message' => 'Expense added successfully',
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function getExpense(): JsonResponse
    {
        $allExpense = Expense::select('id', 'amount', 'expense_category', 'created_at')->get();
        Log::info($allExpense);

        if ($allExpense->isEmpty()) {
            return response()->json([
                "status"=> 404,
                "allIncomes"=> 'Incomes Not found'
            ]);
        }
        return response()->json(
            [
                "status" => 200,
                'allExpense' =>$allExpense
            ]
        );
    }

    public function deleteExpense(Request $request)
    {
        Log::info('Delete request received', ['id' => $request->id]);
        try {
            // Find the income by ID
            $expense = Expense::findOrFail($request->id);

            // Delete the income record
            $expense->delete();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Expense record deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting income record',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

