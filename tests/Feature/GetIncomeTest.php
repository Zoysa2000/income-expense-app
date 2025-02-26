<?php


use App\Models\Income;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetIncomeTest extends TestCase
{
    use RefreshDatabase;

    public function testGetIncome()
    {
        $income1 = Income::factory()->create();
        $income2 = Income::factory()->create();
        $income3 = Income::factory()->create();

        $response = $this->get('/api/get-income');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'status',
                'allIncomes',
            ]
        );

        $response->assertSimilarJson(
            [
                'status' => 200,
                'allIncomes' => [
                    [
                        'id' => $income1['id'],
                        'amount' => $income1['amount'],
                        'income-category' => $income1['income-category'],
                    ],
                    [
                        'id' => $income2['id'],
                        'amount' => $income2['amount'],
                        'income-category' => $income2['income-category'],
                    ],
                    [
                        'id' => $income3['id'],
                        'amount' => $income3['amount'],
                        'income-category' => $income3['income-category'],
                    ]

                ]
            ]
        );


    }
}
