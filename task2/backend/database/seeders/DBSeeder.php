<?php

namespace Database\Seeders;

use App\Models\Email;
use App\Models\Profile;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a new instance of the Faker generator
        $faker = Faker::create();
        $this->seedProfilesEmails($faker);
    }
    private function generateFakeProfile(Generator $faker): array
    {
        return [
            'UserRefID' => $faker->randomNumber(),
            'uuid' => $faker->uuid(),
            'Firstname' => $faker->firstName,
            'Surname' => $faker->lastName,
            'Deceased' => $faker->boolean,
        ];
    }

    private function generateFakeEmail(Generator $faker, int $userRefID): array
    {
        return [
            'UserRefID' => $userRefID,
            'uuid' => $faker->uuid(),
            'emailID' => $faker->randomNumber(4),
            'emailaddress' => $faker->email,
            'Default' => $faker->boolean,
        ];
    }

    private function seedProfilesEmails(Generator $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $profileData = $this->generateFakeProfile($faker);
            $profile = new Profile($profileData);
            $profile->save();

            $emailData = $this->generateFakeEmail($faker, $profileData['UserRefID']);
            $email = new Email($emailData);
            $email->save();
        }
    }
}
