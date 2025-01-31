<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-semibold mb-4">Welcome to Jobyard</h2>

                    @can('manage users')
                        <div class="mb-4">
                            <h3 class="font-bold text-red-600">Admin Panel</h3>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Manage Users</a>
                        </div>
                    @endcan

                    @can('create job')
                        <div class="mb-4">
                            <h3 class="font-bold text-blue-600">Employer Dashboard</h3>
                            <a href="{{ route('jobs.create') }}" class="btn btn-primary">Post a Job</a>
                            <a href="{{ route('jobs.manage') }}" class="btn btn-secondary">Manage Jobs</a>
                        </div>
                    @endcan

                    @can('apply job')
                        <div class="mb-4">
                            <h3 class="font-bold text-green-600">Candidate Dashboard</h3>
                            <a href="{{ route('jobs.index') }}" class="btn btn-success">Find Jobs</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
