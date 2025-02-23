<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{

    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2,10000,100000),
            'income-category' => $this->faker->randomElement(['Monthly Salary','Side Project','Youtube Revenue'])

        ];
    }
}
