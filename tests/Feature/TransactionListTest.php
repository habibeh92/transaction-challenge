<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\Traits\UsersTestTrait;
use Tests\TestCase;

class TransactionListTest extends TestCase
{
    use DatabaseMigrations;
    use UsersTestTrait;


    /**
     * test the page of transactions list
     *
     * @return void
     */
    public function test_transaction_list_page()
    {
        $this->actingAs($this->createAdmin())
             ->get('/transaction/list')
             ->assertSee("From User")
             ->assertSee("To User")
             ->assertSee("Amount")
             ->assertSee("Attachments")
             ->assertSee("Status")
             ->assertSee("Action")
             ->assertStatus(200)
        ;
    }



    /**
     * Test authorisation of the transaction list page
     *
     * @return void
     */
    public function test_transaction_list_page_unauthorised()
    {
        $this->get('/transaction/list')
             ->assertRedirectToRoute("login")
        ;

        $this->actingAs(User::factory()->create())
             ->get('/transaction/list')
             ->assertStatus(403)
        ;
    }

}
