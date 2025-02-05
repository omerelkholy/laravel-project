@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-white text-center mb-8">Edit Job Listing</h1>

        <form action="{{ route('job_listings.update', $jobListing) }}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto bg-[#2d2d30] p-8 rounded-xl shadow-2xl space-y-8">
            @csrf
            @method('PATCH')

            <!-- Accordion Section 1: Job Info -->
            <div class="accordion-item bg-[#1b1919] rounded-md mb-4">
                <button type="button" class="accordion-header text-lg font-semibold text-white w-full px-4 py-3 text-left">
                    Job Info
                </button>
                <div class="accordion-content hidden px-4 py-3">
                    <div class="space-y-4">
                        <label for="title" class="block text-lg font-semibold text-gray-300">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ $jobListing->title }}" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">
                    </div>
                    <div class="space-y-4 mt-6">
                        <label for="salary_range" class="block text-lg font-semibold text-gray-300">Salary Range</label>
                        <input type="text" name="salary_range" id="salary_range" value="{{ $jobListing->salary_range }}" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">
                    </div>
                </div>
            </div>

            <!-- Accordion Section 2: Details -->
            <div class="accordion-item bg-[#1b1919] rounded-md mb-4">
                <button type="button" class="accordion-header text-lg font-semibold text-white w-full px-4 py-3 text-left">
                    Details
                </button>
                <div class="accordion-content hidden px-4 py-3">
                    <div class="space-y-4">
                        <label for="description" class="block text-lg font-semibold text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="4" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">{{ $jobListing->description }}</textarea>
                    </div>

                    <div class="space-y-4 mt-6">
                        <label for="requirements" class="block text-lg font-semibold text-gray-300">Requirements</label>
                        <textarea name="requirements" id="requirements" rows="4" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">{{ $jobListing->requirements }}</textarea>
                    </div>

                    <div class="space-y-4 mt-6">
                        <label for="benefits" class="block text-lg font-semibold text-gray-300">Benefits</label>
                        <textarea name="benefits" id="benefits" rows="4" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">{{ $jobListing->benefits }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Accordion Section 3: Additional Info -->
            <div class="accordion-item bg-[#1b1919] rounded-md mb-4">
                <button type="button" class="accordion-header text-lg font-semibold text-white w-full px-4 py-3 text-left">
                    Additional Info
                </button>
                <div class="accordion-content hidden px-4 py-3">
                    <div class="space-y-4">
                        <label for="location" class="block text-lg font-semibold text-gray-300">Location</label>
                        <input type="text" name="location" id="location" value="{{ $jobListing->location }}" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">
                    </div>

                    <div class="space-y-4 mt-6">
                        <label for="work_type" class="block text-lg font-semibold text-gray-300">Work Type</label>
                        <select name="work_type" id="work_type" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">
                            @foreach (['remote', 'on_site', 'hybrid'] as $type)
                                <option value="{{ $type }}" {{ $type === $jobListing->work_type ? 'selected' : '' }}>{{ ucwords($type) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-4 mt-6">
                        <label for="application_deadline" class="block text-lg font-semibold text-gray-300">Application Deadline</label>
                        <input type="date" name="application_deadline" id="application_deadline" value="{{ $jobListing->application_deadline }}" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">
                    </div>

                    <div class="space-y-4 mt-6">
                        <label for="company_logo" class="block text-lg font-semibold text-gray-300">Company Logo</label>
                        <input type="file" name="company_logo" id="company_logo" class="block w-full px-4 py-3 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-[#ef4444] focus:border-[#ef4444]">
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-8">
                <a href="{{ route('job_listings.index') }}" class="bg-transparent text-white px-6 py-3 rounded-md hover:bg-[#ef4444] hover:text-white transition-all duration-300">Cancel</a>
                <button type="submit" class="bg-[#ef4444] text-white px-6 py-3 rounded-md hover:bg-[#dc2626] transition-all duration-300">Update Job Listing</button>
            </div>
        </form>
    </div>

    <script>
        // Accordion functionality
        document.querySelectorAll('.accordion-header').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const isVisible = content.classList.contains('hidden');

                // Hide all accordion content
                document.querySelectorAll('.accordion-content').forEach(item => {
                    item.classList.add('hidden');
                });

                // If not already visible, show the clicked section
                if (isVisible) {
                    content.classList.remove('hidden');
                }
            });
        });
    </script>
@endsection
