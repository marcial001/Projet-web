<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_factory_creates_a_valid_user_with_default_phone_and_role(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->assertNotNull($user->phone);
        $this->assertNotNull($user->role);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'phone' => $user->phone,
            'role' => $user->role,
        ]);
    }
}
