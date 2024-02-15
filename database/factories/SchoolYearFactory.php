<?php

namespace Database\Factories;
use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolYear>
 */
class SchoolYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SchoolYear::class;

    public function definition()
    {
        $year = $this->faker->numberBetween(2015, 2024);

        return [
            'year' => $year,
        ];
    }
}
