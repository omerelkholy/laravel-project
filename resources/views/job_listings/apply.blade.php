@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <form method="POST" action="{{ route('application.store', ['job_listing' => $jobId]) }}" class="bg-[#141414] p-6 rounded-lg shadow-md">
            @csrf
            <input type="hidden" name="job_id" value="{{ $jobId }}">

            <!-- Two-column grid for number inputs -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-white mb-1">Time</label>
                    <input type="number" name="time" placeholder="Enter the time in days" class="w-full p-3 bg-[#18181b] text-white border border-[#ef4444] focus:border-[#ef4444] focus:ring focus:ring-[#ef4444] rounded">
                </div>
                <div>
                    <label class="block text-white mb-1">Price</label>
                    <input type="number" name="price" step="0.01" placeholder="Enter your price" class="w-full p-3 bg-[#18181b] text-white border border-[#ef4444] focus:border-[#ef4444] focus:ring focus:ring-[#ef4444] rounded">
                </div>
            </div>

            <!-- Offer Description -->
            <div class="mt-4">
                <label class="block text-white mb-1">Application Description</label>
                <textarea name="offer_description" class="w-full p-3 bg-[#18181b] text-white border border-[#ef4444] focus:border-[#ef4444] focus:ring focus:ring-[#ef4444] rounded" placeholder="Enter your offer description"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-[#ef4444] hover:bg-red-600 text-white font-semibold py-3 rounded-full transition duration-300">
                    Submit
                </button>
            </div>
        </form>

        <!-- Back to Listings Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('job_listings.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-full transition duration-300">
                Back to Listings
            </a>
        </div>
    </div>
@endsection
