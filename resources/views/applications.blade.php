<x-app-layout>
    @section('content')
        <div class="container mx-auto px-4 py-8">
            @if (session('success'))
                <div class="mb-6 bg-green-600 text-white px-4 py-3 rounded-lg shadow-md">
                    Your action has been recorded
                </div>
            @endif

            @forelse ($jobListings as $jobListing)
                <div class="mb-8 bg-[#141414] p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-[#ef4444] mb-4">
                        {{ $jobListing->title }}
                    </h2>
                    @if ($jobListing->applications->count() > 0)
                        @foreach ($jobListing->applications as $application)
                            <div class="mb-4 border border-gray-700 p-4 rounded-lg">
                                <p class="text-white">
                                    Status: <span class="font-bold">{{ $application->status }}</span>
                                </p>
                                <div class="flex flex-wrap gap-4 mt-3">
                                    @if ($application->status !== 'rejected')
                                        <form method="POST" action="{{ route('application.reject', ['application' => $application]) }}">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full transition duration-300">
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                    @if ($application->status !== 'accepted')
                                        <form method="POST" action="{{ route('application.approve', ['application' => $application]) }}">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full transition duration-300">
                                                Approve
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-white">No applications found for this job listing.</p>
                    @endif
                </div>
            @empty
                <p class="text-white text-center">No job listings found.</p>
            @endforelse

            <!-- Button to return to profile view -->
            <div class="mt-8 text-center">
                <a href="{{ route('profile') }}" class="bg-[#ef4444] hover:bg-red-600 text-white px-6 py-3 rounded-full shadow-lg transition duration-300">
                    Back to Profile
                </a>
            </div>
        </div>
    @endsection
</x-app-layout>
