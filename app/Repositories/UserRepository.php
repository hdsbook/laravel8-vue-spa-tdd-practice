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
    public function getModel()
    {
        return \App\Models\User::class;
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

    /**
     * create token
     *
     * @param \App\Models\User $user
     * @param string $name
     * @param array $abilities
     * @return string
     */
    public static function createToken(
        $user,
        $name = 'token',
        $abilities = ['*']
    ) {
        $user->tokens()->where('name', $name)->delete();
        return $user->createToken($name, $abilities)->plainTextToken;
    }
}
