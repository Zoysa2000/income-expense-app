<?php


use App\Models\Income;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddIncomeTestTest extends TestCase
{
    public function testAddIncome()
{
    //Arrange
    //dummy data we that need to do the test
     $income = Income::factory()->make()->toArray();
     dd($income);

    //Act or Action
    //implement that we need to test pass (endpoint/class/function)
     $response = $this->post('/api/add-income',$income);

     // Assertion
     $response->assertStatus(200);
     $response->assertJsonStructure(['message']);
     $response->assertSimilarJson(['message'=>'Income added successfully']);

     $this->assertDatabaseHas('income' ,[
         'amount' => $income['amount'],
         'income-category' => $income['income-category'],
     ]);
}


public function testIncomeAmount()
{
    $income = Income::factory()->make(['amount'=>0]
    )->toArray();

    $response = $this->post('/api/add-income',$income);

    $response -> assertSimilarJson([
        'status'=>422,
        'errors'=> [
            'amount'=> ['The amount field must be at least 1.']
        ]
    ]);

}
}
