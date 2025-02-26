<?php

namespace App\Http\Controllers;
use App\Http\Requests\IncomeFormRequest;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

}
