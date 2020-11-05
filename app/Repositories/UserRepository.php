<?php

namespace App\Repositories;

use App\Models\User;

/**
 * class UserRepository
 *
 * @property User $model
 */
class UserRepository extends EloquentRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function isRole($role)
    {
        return $this->model->userRoles()->where('role', $role)->count() > 0;
    }
}
