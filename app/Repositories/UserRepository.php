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

    /**
     * 使用者是否具有某身份
     *
     * @param string $role admin|teacher|student
     * @return boolean
     */
    public function hasRole($role): bool
    {
        return self::checkHasRole($this->model, $role);
    }

    /**
     * 使用者是否具有某身份
     *
     * @param \App\Models\User $user
     * @param string $role admin|teacher|student
     * @return boolean
     */
    public static function checkHasRole($user, $role): bool
    {
        return $user->userRoles()->where('role', $role)->count() > 0;
    }
}
