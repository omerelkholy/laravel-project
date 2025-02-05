<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight bg-nav py-4 px-6 shadow-md">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @section('content')
        <div class="py-12 bg-[#141414]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-[#18181b] overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">
                        <h3 class="text-lg font-semibold mb-4">User Information</h3>
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Phone number:</strong> {{ Auth::user()->phone ?? "No phone number added yet!" }}</p>

                        @if (Auth::user()->role === 'candidate')
                            <div class="mt-4">
                                <p><strong>Bio:</strong></p>
                                @if (Auth::user()->candidate && Auth::user()->candidate->bio)
                                    <p class="dark:text-gray-300">{{ Auth::user()->candidate->bio }}</p>
                                @else
                                    <p class="italic">No bio added yet.</p>
                                @endif
                            </div>
                        @endif

                        @if (Auth::user()->profile_image)
                            <div class="mt-4">
                                <p><strong>Profile Image:</strong></p>
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile Image"
                                     class="w-32 h-32 rounded-full shadow-md">
                            </div>
                        @else
                            <p><strong>Profile Image:</strong> No image uploaded</p>
                        @endif

                        <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>

                        @if (Auth::user()->role === 'employer')
                            <div class="mt-4">
                                <h3 class="font-semibold text-blue-400">Company Information</h3>
                                <p><strong>Company Name:</strong> {{ Auth::user()->employer->company_name ?? 'Freelancer' }}</p>
                            </div>
                        @endif

                        @if (Auth::user()->role === 'candidate' && Auth::user()->candidate->resume)
                            <div class="mt-4">
                                <h3 class="font-semibold text-green-400">Resume</h3>
                                <p><strong>Download CV:</strong>
                                    <a href="{{ asset('storage/' . Auth::user()->candidate->resume) }}"
                                       class="underline" target="_blank">View Resume</a>
                                </p>
                            </div>
                        @endif

                        <div class="mt-6 flex justify-between">
                            <a href="{{ route('profile.edit') }}"
                               class="px-4 py-2 bg-[#ef4444] text-white rounded hover:bg-red-600 transition duration-300">
                                Edit Profile
                            </a>
                            @can('create job')
                                <a href="{{ route('application.index') }}"
                                   class="px-4 py-2 bg-[#ef4444] text-white rounded hover:bg-red-600 transition duration-300">
                                    View Applications
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
