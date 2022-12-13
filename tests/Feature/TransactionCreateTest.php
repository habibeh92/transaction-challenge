<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TransactionCreateTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * test the transaction form page
     *
     * @return void
     */
    public function test_transaction_form_page()
    {
        $this->actingAs(User::factory()->create())
             ->get('/transaction/create')
             ->assertSee("Create Transaction")
             ->assertSee("amount")
             ->assertSee("File")
             ->assertSee("send")
             ->assertStatus(200)
        ;
    }



    /**
     * test transaction form page form guest users
     *
     * @return void
     */
    public function test_transaction_form_page_guest()
    {
        $this->get('/transaction/create')
             ->assertRedirectToRoute("login")
        ;
    }



    /**
     * test creation of the transaction for a valid user
     *
     * @return void
     */
    public function test_transaction_create()
    {
        $from_user = User::factory()->create();
        $to_user   = User::factory()->create();
        Storage::fake();
        $file     = UploadedFile::fake()->create("file.pdf");
        $filename = "attachments/" . $file->hashName();


        $data = [
            "files"      => [$file],
            "amount"     => 5000,
            "to_user_id" => $to_user->id,
        ];

        $this->actingAs($from_user)
             ->post('/transaction/create', $data)
             ->assertSessionHas("message")
        ;

        Storage::disk()->assertExists($filename)
        ;

        $this->assertDatabaseHas("transactions", [
            "amount"       => 5000,
            "from_user_id" => $from_user->id,
            "to_user_id"   => $to_user->id,
        ]);

        $this->assertDatabaseHas("transaction_attachments", [
            "filename"      => $filename,
            "original_name" => $file->getClientOriginalName(),
        ]);
    }



    /**
     * test the validation errors in creating transaction
     *
     * @return void
     */
    public function test_transaction_validation()
    {
        $data = [
            "files"      => "something",
            "amount"     => "something",
            "to_user_id" => 0,
        ];

        $this->actingAs(User::factory()->create())
             ->post('/transaction/create', $data)
             ->assertSessionHasErrors([
                 "files",
                 "amount",
                 "to_user_id",
             ])
        ;
    }


}
