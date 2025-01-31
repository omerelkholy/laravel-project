<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">User Information</h3>
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Phone number:</strong> {{ Auth::user()->phone }}</p>
                    @if(Auth::user()->role === 'candidate')
    <div class="mt-4">
        <p><strong>Bio:</strong></p>
        @if(Auth::user()->candidate && Auth::user()->candidate->bio)
            <p class="text-gray-700 dark:text-gray-300">{{ Auth::user()->candidate->bio }}</p>
        @else
            <p class="text-gray-500 italic">No bio added yet.</p>
        @endif
    </div>
@endif

@if(Auth::user()->profile_image)
    <div class="mt-4">
        <p><strong>Profile Image:</strong></p>
        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile Image" class="w-32 h-32 rounded-full shadow-md">
    </div>
@else
    <p><strong>Profile Image:</strong> No image uploaded</p>
@endif
                    <p><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</p>

                    @if(Auth::user()->role === 'employer')
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-blue-600">Company Information</h3>
                            <p><strong>Company Name:</strong> {{ Auth::user()->employer->company_name ?? 'Freelancer' }}</p>
                        </div>
                    @endif

                    @if(Auth::user()->role === 'candidate' && Auth::user()->candidate->resume)
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-green-600">Resume</h3>
                            <p><strong>Download CV:</strong> 
                                <a href="{{ asset('storage/' . Auth::user()->candidate->resume) }}" class="text-blue-500 underline" target="_blank">View Resume</a>
                            </p>
                        </div>
                    @endif

                    <div class="mt-6">
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-indigo-600 text-white bg-black rounded hover:bg-indigo-700">
    Edit Profile
</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
