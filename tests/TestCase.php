<?php

namespace Tests;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signInById(int $id)
    {
        return $this->signIn(User::find($id));
    }

    public function signIn($user)
    {
        $user = $user ?: User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
}
