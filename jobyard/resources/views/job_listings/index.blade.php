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

    <form class="max-w-md mx-auto my-4" method="get">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for a job here" value="{{request()->get('search')}}"/>
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    <div class="grid grid-cols-1 gap-8 w-full">
        @foreach ($jobListings as $jobListing)
            <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow">
                <h2 class="text-2xl font-semibold mb-4"><strong>Employer Name: </strong>{{ $jobListing->user->name }}</h2>
                <h2 class="text-2xl font-semibold mb-4"><strong>Job: </strong>{{ $jobListing->title }}</h2>
                <p class="mb-2 text-lg"><strong>Location:</strong> {{ $jobListing->location }}</p>
                <p class="mb-2 text-lg"><strong>Work Type:</strong> {{ ucfirst($jobListing->work_type) }}</p>
                <p class="mb-2 text-lg"><strong>Salary Range:</strong> {{ $jobListing->salary_range }}</p>
                <p class="mb-2 text-lg"><strong>Application Deadline:</strong> {{ $jobListing->application_deadline }}</p>
                <p class="mb-4 text-lg"><strong>Status:</strong> {{ ucfirst($jobListing->status) }}</p>
                <a href="{{ route('job_listings.show', $jobListing) }}" class="bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-700 transition duration-300">View</a>
                <a href="{{ route('job_listings.edit', $jobListing) }}" class="bg-green-500 text-white py-2 px-4 rounded-full hover:bg-green-700 transition duration-300">Edit</a>
                <form action="{{ route('job_listings.destroy', $jobListing) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job listing?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-700 transition duration-300">Delete</button>
                </form>

            </div>
        @endforeach
    </div>
</div>
@endsection
