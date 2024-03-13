<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ContactFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    // protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->lastName.$this->faker->firstName,
            'mail' => $this->faker->unique()->safeEmail(),
            'reply' => $this->faker->randomElement(['普通', '急ぎ', '少し急ぎ']),
            'category' => $this->faker->randomElement(['契約について', '解約について', '再契約について', '商品の故障について', 'その他について']),
            'title' => $this->faker->realText(10),
            'content' => $this->faker->realText(rand(50, 100)),
            'created_at' => $this->faker->dateTimeBetween('-3 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-3 year', 'now'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
