<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolYear;


class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startYear = 2015;
        $endYear = 2024;

        for ($year = $startYear; $year <= $endYear; $year++) {
            SchoolYear::create([
                'year' => $year,
            ]);
        }
    }
}
