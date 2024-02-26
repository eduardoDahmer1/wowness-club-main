<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role' => fake()->randomElement(Role::toArray()),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'status' => fake()->boolean(),
            'country_id' => Country::inRandomOrder()->first()->id
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function approved(): self
    {
        return $this->state(['status' => true]);
    }

    public function unapproved(): self
    {
        return $this->state(['status' => false]);
    }

    public function admin(): self
    {
        return $this->state(['role' => Role::Admin]);
    }

    public function maintainer(): self
    {
        return $this->state(['role' => Role::Maintainer]);
    }

    public function serviceProvider(): self
    {
        return $this->state(['role' => Role::ServiceProvider]);
    }

    public function commonUser(): self
    {
        return $this->state(['role' => Role::CommonUser]);
    }
}
