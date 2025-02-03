<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> fake()->jobTitle(),
            'description'=>fake()->text(),
            'requirements'=>fake()->word(),
            'benefits'=>fake()->text(),
            'salary_range'=>fake()->numberBetween(1000,5000),
            'location'=>fake()->city(),
            'company_logo'=>fake()->word(),
            'work_type'=>fake()->randomElement(['remote', 'on_site', 'hybrid']),
            'application_deadline' => fake()->dateTimeBetween('now', '+1 month'),
            'user_id'=> $this->generateEmployerId()
        ];
    }
    private function generateEmployerId() {
       return User::where("user_type",'employer')->select('id')->get()->random();
    }
}

