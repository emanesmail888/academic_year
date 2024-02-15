<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SchoolClass;
// use App\Models\SchoolYear;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolClass>
 */
class SchoolClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SchoolClass::class;

    public function definition()
    {
        return [
            'class_name' => $this->faker->word,
            'school_year_id' => function () {
                // return SchoolYear::factory()->create()->id;
                return rand(1, 10);
            },
        ];
    }
}
