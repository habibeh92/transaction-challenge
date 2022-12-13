<?php

namespace Tests\Feature\Traits;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait UsersTestTrait
{
    /**
     * create a user and assign admin role
     *
     * @param string $email
     * @param string $password
     *
     * @return User
     */
    public function createAdmin(string $email = "admin@info.com", string $password = "123456"): User
    {
        return User::factory()->hasAttached(Role::factory()->create([
            "slug" => "admin",
        ]))->create([
            "email"    => $email,
            "password" => Hash::make($password),
        ])
        ;
    }
}
