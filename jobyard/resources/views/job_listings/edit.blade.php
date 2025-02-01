@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Job Listing</h1>

    <form action="{{ route('job_listings.update', $jobListing) }}" method="POST" class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        @foreach (['title', 'description', 'requirements', 'benefits', 'salary_range', 'location', 'company_logo'] as $field)
            <div class="mb-6">
                <label for="{{ $field }}" class="block text-sm font-medium text-gray-700">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                @if (in_array($field, ['description', 'requirements', 'benefits']))
                    <textarea name="{{ $field }}" id="{{ $field }}" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">{{ $jobListing->$field }}</textarea>
                @else
                    <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ $jobListing->$field }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                @endif
            </div>
        @endforeach

        <div class="mb-6">
            <label for="work_type" class="block text-sm font-medium text-gray-700">Work Type</label>
            <select name="work_type" id="work_type" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                @foreach (['remote', 'on_site', 'hybrid'] as $type)
                    <option value="{{ $type }}" {{ $type === $jobListing->work_type ? 'selected' : '' }}>{{ ucwords($type) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="application_deadline" class="block text-sm font-medium text-gray-700">Application Deadline</label>
            <input type="date" name="application_deadline" id="application_deadline" value="{{ $jobListing->application_deadline }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Update Job Listing</button>
        </div>
    </form>
</div>
@endsection