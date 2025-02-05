<?php

namespace Database\Factories;

use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Symfony\Component\Translation\t;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_listing_id'=> $this->generateJobId(),
            'user_id'=> $this->generateCandidateId(),
            'price'=> fake()->numberBetween(10, 50),
            'description'=>fake()->text(),
            'time'=>"three seconds"
        ];
    }

    private function generateCandidateId() {
        return User::where("role",'candidate')->select('id')->get()->random();
    }

    private function generateJobId() {
        return JobListing::select('id')->get()->random();
    }
}
