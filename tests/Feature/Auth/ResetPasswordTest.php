<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    public function testResetPasswordPage()
    {
        $response = $this->get(route('password.reset', [
            'token' => 'fake-token'
        ]));

        $response->assertSuccessful();
    }

    public function testResetPassword()
    {
        $customToken = 'custom-token';

        $user = User::factory()->create();
        DB::insert('insert into password_resets (`email`, `token`, `created_at`) values (?, ?, ?)', [
            $user->email,
            Hash::make($customToken),
            now()
        ]);

        $response = $this->post(route('password.update', [
            'email' => $user->email,
            'token' => $customToken,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('password_resets', [
            'email' => $user->email
        ]);
        $this->assertTrue(
            Hash::check('newpassword', User::find($user->id)->password)
        );
    }
}
