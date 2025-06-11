<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * 系统默认头像
     *
     * @var array|string[]
     */
    public array $avatars = [
        "/uploads/images/default-avatar/200.jpg",
        "/uploads/images/default-avatar/300.jpg",
        "/uploads/images/default-avatar/400.jpg",
        "/uploads/images/default-avatar/500.jpg",
        "/uploads/images/default-avatar/600.jpg",
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('11111111'),
            'remember_token' => Str::random(10),
            'introduction' => fake()->sentence(),
            'avatar' => config('app.url') . fake()->randomElement($this->avatars),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
