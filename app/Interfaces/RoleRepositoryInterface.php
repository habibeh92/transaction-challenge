<?php

namespace App\Interfaces;

use App\Models\Role;

interface RoleRepositoryInterface
{
    /**
     * register the user
     *
     * @param array $data
     *
     * @return Role
     */
    public function create(array $data): Role;



    /**
     * get admin role model
     *
     * @return Role
     */
    public function adminRole(): Role;



    /**
     * get user role model
     *
     * @return Role
     */
    public function userRole(): Role;
}
