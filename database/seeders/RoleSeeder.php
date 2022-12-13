<?php

namespace Database\Seeders;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    private RoleRepositoryInterface $roleRepository;



    /**
     * UserController constructor
     *
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!$this->roleRepository->adminRole()->exists) {
            $this->roleRepository->create([
                "title" => "admin",
                "slug"  => "admin",
            ]);
        }
    }
}
