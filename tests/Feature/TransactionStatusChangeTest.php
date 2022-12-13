<?php

namespace Tests\Feature;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\App;
use Tests\Feature\Traits\UsersTestTrait;
use Tests\TestCase;

class TransactionStatusChangeTest extends TestCase
{
    use DatabaseMigrations;
    use UsersTestTrait;


    /**
     * test the authorisation of changing status
     *
     * @return void
     */
    public function test_transaction_change_status_unauthorised()
    {
        $this->actingAs(User::factory()->create())
             ->post('/transaction/change-status/' . $this->createTransaction()->id)
             ->assertStatus(403)
        ;
    }



    /**
     * test changing status of a transaction by an admin
     *
     * @return void
     */
    public function test_transaction_change_status()
    {
        $transaction = $this->createTransaction();
        $this->actingAs($this->createAdmin())
             ->post('/transaction/change-status/' . $transaction->id, [
                 "status" => Transaction::STATUS_CONFIRMED,
             ])
             ->assertStatus(302)
        ;

        $this->assertDatabaseHas("transactions", [
            "id"     => $transaction->id,
            "status" => Transaction::STATUS_CONFIRMED,
        ]);
    }



    /**
     * test validation errors of changing status of a transaction
     *
     * @return void
     */
    public function test_transaction_change_status_validation()
    {
        $transaction = $this->createTransaction();
        $this->actingAs($this->createAdmin())
             ->post('/transaction/change-status/' . $transaction->id)
             ->assertStatus(302)
             ->assertSessionHasErrors([
                 "status",
             ])
        ;
    }



    /**
     * create transaction for tests
     *
     * @return Transaction
     */
    private function createTransaction(): Transaction
    {
        /** @var TransactionRepositoryInterface $repository */
        $repository = App::make(TransactionRepositoryInterface::class);
        $data       = [
            "amount"       => 5000,
            "from_user_id" => User::factory()->create()->id,
            "to_user_id"   => User::factory()->create()->id,
        ];
        return $repository->create($data);
    }


}
