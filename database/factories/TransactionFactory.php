<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{

    protected $model = Transaction::class;



    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2),
            "status" => Arr::random([
                Transaction::STATUS_DRAFT,
                Transaction::STATUS_CONFIRMED,
                Transaction::STATUS_REJECTED,
            ]),
        ];
    }
}
