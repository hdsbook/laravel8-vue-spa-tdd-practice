<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRegisterPage()
    {
        $response = $this->get(route('register'));

        $response->assertSuccessful();
    }

    public function testRegister()
    {
        $user = User::factory()->make();
        $response = $this->post(route('register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(url('/'));
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
        $this->assertTrue(
            Hash::check('password', User::where('email', $user->email)->first()->password)
        );
    }
}
