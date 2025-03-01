<?php

namespace App\Http\Controllers;
use App\Http\Requests\IncomeFormRequest;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class IncomeController extends Controller
{
    public function addIncome(IncomeFormRequest $request): JsonResponse
    {

        $validatedIncomeDetails = $request->validated();

        Log::info($validatedIncomeDetails);

        Income::create([
            'amount' => $validatedIncomeDetails['amount'],
            'income-category' => $validatedIncomeDetails['income-category'],
            //associative array
        ]);

        return response()->json([
            'message' => 'Income added successfully',
        ]);
    }


    public function getIncome()
    {
        $allIncomes = Income::select('id', 'amount', 'income-category', 'created_at')->get();
        Log::info($allIncomes);

        if ($allIncomes->isEmpty()) {
            return response()->json([
                "status"=> 404,
                "allIncomes"=> 'Incomes Not found'
            ]);
        }
        return response()->json(
        [
            "status" => 200,
            'allIncomes' =>$allIncomes
        ]
    );
    }
    public function deleteIncome(Request $request)
    {
        Log::info('Delete request received', ['id' => $request->id]);
        try {
            // Find the income by ID
            $income = Income::findOrFail($request->id);

            // Delete the income record
            $income->delete();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Income record deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting income record',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function updateIncome(Request $request)
    {
        $validatedIncomeDetails = $request->validate([
            'amount' => ['required', 'numeric', 'min:100'],
            'income-category' => 'required|string',
        ]);

        try
        {
            $income = Income::find($request->id);
            $income->update([
                'amount' => $validatedIncomeDetails['amount'],
                'income-category' => $validatedIncomeDetails['income-category'],
            ]);

            // Return success response
            return response()->json([
                'message' => 'Income updated successfully',
            ], 200);
        }
        catch (ValidationException $e)
        {
            return response()->json([
                'error' => 'Validation failed',
                'message' => $e->errors()
            ], 422);
        }





    }

}
