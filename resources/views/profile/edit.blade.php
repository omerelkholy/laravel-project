<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight bg-nav py-4 px-6 shadow-md">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @section('content')
        <div class="py-12 bg-[#141414] min-h-screen flex justify-center">
            <div class="w-full max-w-4xl space-y-8 px-6">
                <!-- Personal Information Update Section -->
                <div class="p-6 bg-gray-800 shadow-lg border border-gray-700 rounded-xl">
                    <div class="text-gray-300">
                        <x-update-profile-information-form :user="$user" />
                    </div>
                </div>

                <!-- Password Update Section -->
                <div class="p-6 bg-gray-800 shadow-lg border border-gray-700 rounded-xl">
                    <div class="text-gray-300">
                        <x-update-password-form :user="$user" />
                    </div>
                </div>

                <!-- Account Deletion Section -->
                <div class="p-6 bg-red-800 shadow-lg border border-red-700 rounded-xl">
                    <div class="text-white">
                        <x-delete-user-form :user="$user" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Styles -->
        <style>
            /* Form Input Styles */
            textarea, input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
                background-color: #2d3748; /* Darker background */
                color: #e5e7eb; /* Light gray text */
                border: 1px solid #4a5568; /* Lighter gray border */
                padding: 0.5rem;
                border-radius: 0.5rem;
                width: 100%;
            }

            /* Input Focus */
            textarea:focus, input[type="file"]:focus, input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
                outline: none;
                border-color: #ef4444; /* Red border on focus */
            }

            /* Optional: Add some spacing to form elements */
            textarea, input {
                margin-bottom: 1rem;
            }
        </style>
    @endsection
</x-app-layout>
