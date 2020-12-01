<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\News;
use App\Models\UserRole;


class UserTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testNewsRelation()
    {
        $news = News::factory()->times(3)->create([
            'user_id' => $this->user,
        ]);

        $this->assertEquals(
            $news->toArray(),
            $this->user->news->toArray()
        );
    }

    public function testUserRolesRelation()
    {
        $userRoles = UserRole::factory()->create([
            'user_id' => $this->user
        ]);

        $this->assertEquals(
            $userRoles->toArray(),
            $this->user->userRoles->first()->toArray()
        );
    }
}
