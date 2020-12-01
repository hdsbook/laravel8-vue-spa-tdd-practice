<?php

namespace Tests\Feature\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\isNull;

/**
 * class UserRepositoryTest
 *
 * @property UserRepository $userRepo
 */
class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $userRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepo = new UserRepository();
    }

    public function testFindOrCreate()
    {
        /** @given id, target user */
        $id = 10;
        $targetUser = $this->userRepo->getById($id);

        /** @when find or create */
        $user = $this->userRepo->findOrCreate($id);

        /** @then check found or created */
        $this->assertNotNull($user);
        isNull($targetUser)
            ? $this->assertNotEquals($id, $user->id)   // created
            : $this->assertEquals($targetUser, $user); // found
    }
}
