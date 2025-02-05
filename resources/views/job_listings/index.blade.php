@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="font-semibold text-2xl text-white leading-tight  py-4 px-6 shadow-md text-center mb-8">
            Discover Your Next Career Move
        </h1>

        @if (session('success'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 text-center">{{ session('success') }}</div>
        @endif
        @can('create job')
            <div class="mb-6 text-center">
                <a href="{{ route('job_listings.create') }}"
                   class="bg-[#ef4444] text-white px-6 py-3 rounded-full shadow-lg hover:bg-red-600 transition duration-300">+
                    Post a Job</a>
            </div>
        @endcan
        <form class="max-w-lg mx-auto my-6 relative" method="get">
            <input type="search" id="default-search" name="search"
                   class="block w-full p-4 pl-10 text-lg text-gray-900 border border-gray-300 rounded-full bg-[#141414] text-white focus:ring-red-500 focus:border-red-500"
                   placeholder="Search for jobs..." value="{{ request()->get('search') }}"/>
            <button type="submit"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-[#ef4444] text-white px-6 py-2 rounded-full hover:bg-red-600 transition duration-300">
                Search
            </button>
        </form>

        <div class=" text-white rounded-xl shadow-xl border border-gray-700 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobListings as $jobListing)
                    <div
                        class="relative bg-[#0f0e0e] text-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow overflow-hidden">
                        <h2 class="text-2xl font-semibold text-[#ef4444]">{{ $jobListing->title }}</h2>
                        <p class="text-gray-300"><strong>Employer:</strong> {{ $jobListing->user->name }}</p>
                        <p class="text-gray-300"><strong>Location:</strong> {{ $jobListing->location }}</p>
                        <p class="text-gray-300"><strong>Work Type:</strong> {{ ucfirst($jobListing->work_type) }}</p>
                        <p class="text-gray-300"><strong>Salary:</strong> {{ $jobListing->salary_range }}</p>
                        <p class="text-gray-300"><strong>Deadline:</strong> {{ $jobListing->application_deadline }}</p>
                        <div class="flex flex-wrap gap-2 mt-4">
                            <a href="{{ route('job_listings.show', $jobListing) }}"
                               class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300">View</a>
                            @can('create job')
                                @if(auth()->id() === $jobListing->user_id)
                                    <a href="{{ route('job_listings.edit', $jobListing) }}"
                                       class="bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 transition duration-300 dark:bg-green-700 dark:hover:bg-green-800">Edit</a>

                                    <form action="{{ route('job_listings.destroy', $jobListing) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this job listing?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition duration-300 dark:bg-red-700 dark:hover:bg-red-800">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            @endcan
                            @can('apply job')
                                <a href="{{route('application.create', ['job_listing'=> $jobListing])}}"
                                   class="bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition duration-300 dark:bg-yellow-600 dark:hover:bg-yellow-700">Apply</a>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
