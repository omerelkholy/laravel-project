@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-white text-center">Create New Job Listing</h1>

        <!-- Form Wrapper -->
        <form action="{{ route('job_listings.store') }}" method="POST" enctype="multipart/form-data" id="jobForm" class="max-w-3xl mx-auto bg-[#1b1919] p-8 rounded-lg shadow-md">
            @csrf

            <!-- Step Navigation -->
            <div class="mb-6 flex justify-between">
                <div class="flex justify-end mx-2">
                    <a href="{{ route('job_listings.index') }}" class="bg-transparent-600 text-white px-4 py-2 rounded-md hover:bg-red-400">Cancel</a>
                </div>
                <button type="button" id="prevBtn" class="bg-[#ef4444] text-white px-4 py-2 rounded-md hover:bg-[#d63031] focus:outline-none focus:ring-2 focus:ring-red-500 hidden">Previous</button>
                <button type="button" id="nextBtn" class="bg-[#ef4444] text-white px-4 py-2 rounded-md hover:bg-[#d63031] focus:outline-none focus:ring-2 focus:ring-red-500">Next</button>
            </div>

            <!-- Steps Container -->
            <div class="steps-container">
                <!-- Step 1: Job Information -->
                <div class="step" id="step1">
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-300">Job Title</label>
                        <input type="text" name="title" id="title" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300">Job Description</label>
                        <textarea name="description" id="description" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500"></textarea>
                    </div>
                </div>

                <!-- Step 2: Requirements and Benefits -->
                <div class="step hidden" id="step2">
                    <div class="mb-6">
                        <label for="requirements" class="block text-sm font-medium text-gray-300">Job Requirements</label>
                        <textarea name="requirements" id="requirements" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500"></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="benefits" class="block text-sm font-medium text-gray-300">Job Benefits</label>
                        <textarea name="benefits" id="benefits" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500"></textarea>
                    </div>
                </div>

                <!-- Step 3: Salary, Location, and Work Type -->
                <div class="step hidden" id="step3">
                    <div class="mb-6">
                        <label for="salary_range" class="block text-sm font-medium text-gray-300">Salary Range</label>
                        <input type="text" name="salary_range" id="salary_range" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div class="mb-6">
                        <label for="location" class="block text-sm font-medium text-gray-300">Job Location</label>
                        <input type="text" name="location" id="location" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div class="mb-6">
                        <label for="work_type" class="block text-sm font-medium text-gray-300">Work Type</label>
                        <select name="work_type" id="work_type" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500">
                            @foreach (['remote', 'on_site', 'hybrid'] as $type)
                                <option value="{{ $type }}">{{ ucwords($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Step 4: Logo and Deadline -->
                <div class="step hidden" id="step4">
                    <div class="mb-6">
                        <label for="company_logo" class="block text-sm font-medium text-gray-300">Company Logo</label>
                        <input type="file" name="company_logo" id="company_logo" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500">
                    </div>
                    <div class="mb-6">
                        <label for="application_deadline" class="block text-sm font-medium text-gray-300">Application Deadline</label>
                        <input type="date" name="application_deadline" id="application_deadline" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script>
        let currentStep = 1;

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.step').forEach(stepEl => stepEl.classList.add('hidden'));
            // Show current step
            document.getElementById(`step${step}`).classList.remove('hidden');

            // Show/Hide Navigation Buttons
            if (step === 1) {
                document.getElementById('prevBtn').classList.add('hidden');
            } else {
                document.getElementById('prevBtn').classList.remove('hidden');
            }

            if (step === 4) {
                document.getElementById('nextBtn').textContent = 'Submit';
            } else {
                document.getElementById('nextBtn').textContent = 'Next';
            }
        }

        document.getElementById('nextBtn').addEventListener('click', function () {
            if (currentStep < 4) {
                currentStep++;
                showStep(currentStep);
            } else {
                document.getElementById('jobForm').submit();
            }
        });

        document.getElementById('prevBtn').addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });

        // Initial step
        showStep(currentStep);
    </script>
@endsection
