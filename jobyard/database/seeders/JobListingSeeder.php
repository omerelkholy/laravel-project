<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Seeder;

class JobListingSeeder extends Seeder
{
    public function run()
    {
        JobListing::factory()->count(20)->create(); 
    }
}