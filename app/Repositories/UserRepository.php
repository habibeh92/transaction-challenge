<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    protected User $model;



    /**
     * UserRepository constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }



    /**
     * @inheritDoc
     */
    public function register(array $data): User
    {
        return $this->model = $this->model->create($data);
    }



    /**
     * @inheritDoc
     */
    public function findByUsername(string $username): User
    {
        return $this->model->where("username", $username)->firstOrNew()
        ;
    }



    /**
     * @inheritDoc
     */
    public function paginate(): Collection
    {
        return $this->model->paginate(15);
    }



    /**
     * @inheritDoc
     */
    public function listIds(): array
    {
        return $this->model->pluck("id")->toArray()
        ;
    }



    /**
     * @inheritDoc
     */
    public function assignRole(Role $role)
    {
        $this->model->roles()->attach($role->id)
        ;
    }



    /**
     * @inheritDoc
     */
    public function list(): Collection
    {
        return $this->model->all();
    }



    /**
     * @inheritDoc
     */
    public function listExcept(User $user, array $select = ["*"]): Collection
    {
        return $this->model->select($select)->where("id", "!=", $user->id)->get()
        ;
    }



    /**
     * @inheritDoc
     */
    public function hasRole(string $role_slug): bool
    {
        return $this->model->roles()->where("slug", $role_slug)->exists()
        ;
    }
}
