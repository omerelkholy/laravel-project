@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-white">{{ $jobListing->title }}</h1>

    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        @foreach (['Description', 'Requirements', 'Benefits', 'Salary Range', 'Location', 'Work Type', 'Deadline', 'Company Logo', 'Status'] as $field)
            <p class="text-gray-300"><strong>{{ $field }}:</strong> 
                @if($field == 'Company Logo')
                    <img src="{{ asset('storage/' . $jobListing->{strtolower(str_replace(' ', '_', $field))}) }}" alt="{{ $jobListing->title }} Logo" class="mt-2 max-w-xs rounded-md">
                @else
                    {{ $jobListing->{strtolower(str_replace(' ', '_', $field))} }}
                @endif
            </p>
        @endforeach
    </div>

    <div class="mt-6">
        <a href="{{ route('job_listings.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Back to Listings</a>
    </div>
</div>
@endsection
