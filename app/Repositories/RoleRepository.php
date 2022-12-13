<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{

    /**
     * @var Role
     */
    protected Role $model;



    /**
     * UserRepository constructor
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }



    /**
     * @inheritDoc
     */
    public function create(array $data): Role
    {
        return $this->model = $this->model->create($data);
    }



    /**
     * @inheritDoc
     */
    public function adminRole(): Role
    {
        return $this->model->where("slug", "admin")->firstOrNew()
        ;
    }



    /**
     * @inheritDoc
     */
    public function userRole(): Role
    {
        return $this->model->where("slug", "user")->firstOrNew()
        ;
    }

}
