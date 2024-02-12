<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'picture' => '/../img/henry.png',
        ];
    }
}
