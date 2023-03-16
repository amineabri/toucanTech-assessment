<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\School;
use Illuminate\Database\Seeder;

class MigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $countries = Country::factory(10)->create();
        $countries->each(function ($country) {
            School::factory(rand(1, 5))->create(['country_id' => $country->id]);
        });
    }
}
