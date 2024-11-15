<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemberCard>
 */
class MemberCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'title' => $this->faker->jobTitle(),
            'age' => $this->faker->numberBetween(18, 65),
            'email' => $this->faker->safeEmail(),
            'order' => $this->faker->numberBetween(0, 100),
            'mobile_number' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['un_claimed', 'first_contact', 'preparing_work_offer', 'send_to_therapist']),

        ];
    }
}
