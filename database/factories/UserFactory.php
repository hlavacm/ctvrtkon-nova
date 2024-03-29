<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    const TEST_PASSWORD = "password";

    protected static ?string $password;

    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "email" => fake()->unique()->safeEmail(),
            "email_verified_at" => now(),
            "password" => static::$password ??= Hash::make(self::TEST_PASSWORD),
            "role" => $this->faker->randomElement(RoleEnum::keys()),
            "remember_token" => Str::random(10),
        ];
    }

    public function referenced()
    {
        return $this->state(function (array $attributes) {
            return [];
        });
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            "email_verified_at" => null,
        ]);
    }
}
