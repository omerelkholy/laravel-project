<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight bg-nav py-4 px-6 shadow-md">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Add a custom background color to the body of the page -->
    <div class="py-12 bg-[#141414]"> <!-- Darker background for the body -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Your content will go here -->
        </div>
    </div>
</x-app-layout>
