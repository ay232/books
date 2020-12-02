<?php

namespace Database\Factories;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $isDead = $this->faker->boolean(10);
        $dateOfDeath = $this->faker->dateTimeBetween(now()->subYears(200), now()->subDays(100));
        $ageDays = $this->faker->numberBetween(30, 90) * 365 - $this->faker->numberBetween(1, 300);
        $dateOfBirth = Carbon::parse($dateOfDeath)->subDays($ageDays);
        if (!$isDead) {
            $dateOfDeath = null;
        }
        return [
            'first_name'  => $this->faker->firstName,
            'second_name' => mb_strtoupper($this->faker->randomLetter) . '.',
            'last_name'   => $this->faker->lastName,
            'birth_date'  => $dateOfBirth,
            'death_date'  => $dateOfDeath,
        ];
    }
}
