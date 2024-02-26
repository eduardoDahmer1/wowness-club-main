<?php

namespace Database\Factories;

use App\Enums\Method;
use App\Enums\Target;
use App\Enums\Type;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'method' => $this->faker->randomElement(Method::toArray()),
            'type' => $this->faker->randomElement(Type::toArray()),
            'target' => $this->faker->randomElement(Target::toArray()),
            'user_id' => User::factory(),
            'uses' => $this->faker->randomNumber(1),
            'group_size' => $this->faker->randomNumber(2),
            'description' => $this->faker->text(),
            'name' => $this->faker->word(),
            'highlights' => $this->faker->text(),
            'benefits' => $this->faker->text(),
            'transport' => $this->faker->text(),
            'included' => $this->faker->text(),
            'not_included' => $this->faker->text(),
            'city' => $this->faker->city(),
            'country_id' => Country::inRandomOrder()->first()->id,
            'photo' => $this->faker->imageUrl(),
            'directions' => $this->faker->text(),
            'next_steps' => $this->faker->text(),
            'schedule' => $this->faker->text(),
            'start' => $this->faker->dateTimeBetween('now', '+1 year'),
            'end' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
