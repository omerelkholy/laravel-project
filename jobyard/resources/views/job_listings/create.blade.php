@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-white">Create New Job Listing</h1>

    <form action="{{ route('job_listings.store') }}" method="POST" class="max-w-2xl mx-auto bg-gray-800 p-8 rounded-lg shadow-md">
        @csrf

        @foreach (['title', 'description', 'requirements', 'benefits', 'salary_range', 'location', 'company_logo'] as $field)
            <div class="mb-6">
                <label for="{{ $field }}" class="block text-sm font-medium text-gray-300">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                @if (in_array($field, ['description', 'requirements', 'benefits']))
                    <textarea name="{{ $field }}" id="{{ $field }}" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                @else
                    <input type="text" name="{{ $field }}" id="{{ $field }}" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                @endif
            </div>
        @endforeach

        <div class="mb-6">
            <label for="work_type" class="block text-sm font-medium text-gray-300">Work Type</label>
            <select name="work_type" id="work_type" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                @foreach (['remote', 'on_site', 'hybrid'] as $type)
                    <option value="{{ $type }}">{{ ucwords($type) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="application_deadline" class="block text-sm font-medium text-gray-300">Application Deadline</label>
            <input type="date" name="application_deadline" id="application_deadline" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Create Job Listing</button>
        </div>
    </form>
</div>
@endsection
