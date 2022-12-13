<?php

namespace App\Interfaces;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

interface UserRepositoryInterface
{
    /**
     * register the user
     *
     * @param array $data
     *
     * @return User
     */
    public function register(array $data): User;



    /**
     * find user model by the username
     *
     * @param string $username
     *
     * @return User
     */
    public function findByUsername(string $username): User;



    /**
     * list of users
     *
     * @return Collection
     */
    public function list(): Collection;



    /**
     * list of users except the given user
     *
     * @param User  $user
     * @param array $select
     *
     * @return Collection
     */
    public function listExcept(User $user, array $select = ["*"]): Collection;



    /**
     * list of user ids
     *
     * @return array
     */
    public function listIds(): array;



    /**
     * assign a role to an user
     *
     * @param Role $role
     *
     * @return void
     */
    public function assignRole(Role $role);



    /**
     * check if the user has role slug
     *
     * @param string $role_slug
     *
     * @return bool
     */
    public function hasRole(string $role_slug): bool;


}
