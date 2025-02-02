<?php

namespace Database\Factories;

use App\Models\JobListing;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job_Tag>
 */
class JobTagFactory extends Factory
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
            'tag_id'=> $this->generateTagId(),
        ];
    }

    private function generateJobId() {
        return JobListing::select('id')->get()->random();
    }

    private function generateTagId() {
        return Tag::select('id')->get()->random();
    }
}
