<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\Feature\Traits\UsersTestTrait;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use DatabaseMigrations;
    use UsersTestTrait;


    /**
     * Test the login page
     *
     * @return void
     */
    public function test_login_page()
    {
        $this->get('/login')
             ->assertSee("Login")
             ->assertSee("Email")
             ->assertSee("Password")
             ->assertSee("Sign in")
             ->assertStatus(200)
        ;
    }



    /**
     * test login by an admin
     *
     * @return void
     */
    public function test_login_admin()
    {
        $email    = "admin@info.com";
        $password = "123456";

        $this->createAdmin($email, $password);

        $this->post('/login', ["email" => $email, "password" => $password])
             ->assertStatus(302)
             ->assertRedirectToRoute("transaction-list")
        ;
    }



    /**
     * test login by a user
     *
     * @return void
     */
    public function test_login_user()
    {
        $email    = "user@info.com";
        $password = "123456";

        User::factory()->create([
            "email"    => $email,
            "password" => Hash::make($password),
        ])
        ;

        $this->post('/login', ["email" => $email, "password" => $password])
             ->assertStatus(302)
             ->assertRedirectToRoute("transaction-form")
        ;
    }
}
