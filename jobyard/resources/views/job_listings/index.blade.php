@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-white text-center">Job Listings</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <div class="mb-6 text-center">
        <a href="{{ route('job_listings.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-800 transition duration-300">Create New Job Listing</a>
    </div>

    <div class="grid grid-cols-1 gap-8 w-full">
        @foreach ($jobListings as $jobListing)
            <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow">
                <h2 class="text-2xl font-semibold mb-4">{{ $jobListing->title }}</h2>
                <p class="mb-2 text-lg"><strong>Location:</strong> {{ $jobListing->location }}</p>
                <p class="mb-2 text-lg"><strong>Work Type:</strong> {{ ucfirst($jobListing->work_type) }}</p>
                <p class="mb-2 text-lg"><strong>Salary Range:</strong> {{ $jobListing->salary_range }}</p>
                <p class="mb-2 text-lg"><strong>Application Deadline:</strong> {{ $jobListing->application_deadline }}</p>
                <p class="mb-4 text-lg"><strong>Status:</strong> {{ ucfirst($jobListing->status) }}</p>
                <a href="{{ route('job_listings.show', $jobListing) }}" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition duration-300">View</a>
                <a href="{{ route('job_listings.show', $jobListing) }}" class="bg-green-500 text-white py-2 px-4 rounded-full hover:bg-green-700 transition duration-300">Apply</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
