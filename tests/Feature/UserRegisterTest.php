<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * test registration page
     *
     * @return void
     */
    public function test_register_page()
    {
        $this->get('/register')
             ->assertSee("Register User")
             ->assertSee("Name")
             ->assertSee("Username")
             ->assertSee("Email")
             ->assertSee("Password")
             ->assertSee("Password Confirmation")
             ->assertSee("Sign up")
             ->assertStatus(200)
        ;
    }



    /**
     * test registration of a user
     *
     * @return void
     */
    public function test_register_user()
    {
        $data = [
            "email"                 => "test@info.com",
            "username"              => "test",
            "name"                  => "test",
            "password"              => "12345678",
            "password_confirmation" => "12345678",
        ];

        $this->post("/register", $data)
             ->assertStatus(302)
             ->assertRedirectToRoute("transaction-form")
        ;

        $this->assertDatabaseHas("users", [
            "email"    => "test@info.com",
            "username" => "test",
            "name"     => "test",
        ]);
    }



    /**
     * test validation errors of registration
     *
     * @return void
     */
    public function test_register_Validation()
    {
        $data = [
            "email"    => "something",
            "name"     => "test",
            "password" => "123456",
        ];

        $this->post("/register", $data)
             ->assertSessionHasErrors([
                 "email",
                 "username",
                 "password",
             ])
        ;

    }
}
