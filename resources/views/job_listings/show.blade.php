@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-white text-center mb-8">{{ $jobListing->title }}</h1>

        <div class=" p-8 rounded-lg shadow-xl space-y-8">
            <!-- Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Description Card -->
                <div
                    class="card bg-[#1b1919] p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-[#ef4444] text-xl font-semibold mb-4">Description</h3>
                    <p class="text-gray-300 text-md truncate">{{ Str::limit($jobListing->description, 150) }}</p>
                    <button
                        class="mt-4 bg-[#ef4444] text-white py-2 px-4 rounded-lg hover:bg-[#dc2626] transition-all duration-300"
                        onclick="toggleDetails('description')">View More
                    </button>
                    <div class="text-gray-300 hidden mt-4" id="description-full">
                        <p>{{ $jobListing->description }}</p>
                    </div>
                </div>

                <!-- Requirements Card -->
                <div
                    class="card bg-[#1b1919] p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-[#ef4444] text-xl font-semibold mb-4">Requirements</h3>
                    <p class="text-gray-300 text-md truncate">{{ Str::limit($jobListing->requirements, 150) }}</p>
                    <button
                        class="mt-4 bg-[#ef4444] text-white py-2 px-4 rounded-lg hover:bg-[#dc2626] transition-all duration-300"
                        onclick="toggleDetails('requirements')">View More
                    </button>
                    <div class="text-gray-300 hidden mt-4" id="requirements-full">
                        <p>{{ $jobListing->requirements }}</p>
                    </div>
                </div>

                <!-- Salary Card -->
                <div
                    class="card bg-[#1b1919] p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-[#ef4444] text-xl font-semibold mb-4">Salary</h3>
                    <p class="text-gray-300 text-md">{{ $jobListing->salary_range }}</p>
                </div>

                <!-- Location Card -->
                <div
                    class="card bg-[#1b1919] p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-[#ef4444] text-xl font-semibold mb-4">Location</h3>
                    <p class="text-gray-300 text-md">{{ $jobListing->location }}</p>
                </div>

                <!-- Work Type Card -->
                <div
                    class="card bg-[#1b1919] p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-[#ef4444] text-xl font-semibold mb-4">Work Type</h3>
                    <p class="text-gray-300 text-md">{{ $jobListing->work_type }}</p>
                </div>

                <!-- Deadline Card -->
                <div
                    class="card bg-[#1b1919] p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-[#ef4444] text-xl font-semibold mb-4">Deadline</h3>
                    <p class="text-gray-300 text-md">{{ $jobListing->application_deadline }}</p>
                </div>

                <!-- Company Logo Card -->
                <div
                    class="card bg-[#1b1919] p-6 rounded-lg shadow-md transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-[#ef4444] text-xl font-semibold mb-4">Company Logo</h3>
                        <img src="{{ asset('storage/' . $jobListing->company_logo) }}"
                             alt="{{ $jobListing->title }} Logo"
                             class="rounded-lg max-w-xs border-4 border-[#ef4444] shadow-md mx-auto">
                </div>
            </div>

            <!-- Employer Info Section -->
            <div class="mt-8 text-center">
                <p class="text-[#ef4444] text-lg font-semibold">Employer: {{ $jobListing->user->name }}</p>
            </div>

            <!-- Back to Listings Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('job_listings.index') }}"
                   class="bg-[#ef4444] text-white px-8 py-3 rounded-lg text-lg font-medium shadow-md hover:bg-[#dc2626] hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
                    Back to Listings
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle the details of each card
        function toggleDetails(section) {
            const fullContent = document.getElementById(`${section}-full`);
            fullContent.classList.toggle('hidden');
        }
    </script>
@endsection
