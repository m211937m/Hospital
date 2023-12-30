<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */


class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'name' => $this->faker->name,
            'appointments' => $this->faker->randomElement(['saturday','sunday','monday','tuseday','wednesday','thesday','friday']),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$VF7srluY1pW6wv0XZzTENOODfVb2UUTZm/uD.1tOXbaTY38CRkRsC',
            'phone' =>$this->faker->phoneNumber(),
            'section_id' => Section::all()->random()->id,

        ];
    }
}
