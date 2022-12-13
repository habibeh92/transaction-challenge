<?php

namespace Database\Seeders;

use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $roleRepository;



    /**
     * UserController constructor
     *
     * @param UserRepositoryInterface $userRepository
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedAdmin();
    }



    /**
     * seed one admin
     *
     * @return void
     */
    private function seedAdmin()
    {
        if (!$this->userRepository->findByUsername("admin")->exists) {
            DB::transaction(function () {
                $this->userRepository->register([
                    "name"              => "Admin",
                    "username"          => "admin",
                    "password"          => Hash::make("123456"),
                    "email"             => "admin@info.com",
                    'email_verified_at' => now(),
                ]);
                $this->userRepository->assignRole($this->roleRepository->adminRole());
            });
        }
    }
}
