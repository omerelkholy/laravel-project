<?php

namespace Database\Factories;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobListingFactory extends Factory
{
    protected $model = JobListing::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::where('role', 'employer')->first()->id,
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'requirements' => $this->faker->sentence,
            'benefits' => $this->faker->sentence,
            'salary_range' => '$' . $this->faker->numberBetween(50000, 120000),
            'location' => $this->faker->city,
            'work_type' => $this->faker->randomElement(['remote', 'on_site', 'hybrid']),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
            'company_logo' => null, 
            'status' => 'approved',
        ];
    }
}