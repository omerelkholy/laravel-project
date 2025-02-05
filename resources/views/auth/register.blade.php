<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="bg-[#2c2f34] p-6 rounded-lg shadow-lg">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input id="name" class="block mt-1 w-full bg-[#18181b] text-white border-[#ef4444] focus:border-[#ef4444] focus:ring-[#ef4444] rounded-md" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full bg-[#18181b] text-white border-[#ef4444] focus:border-[#ef4444] focus:ring-[#ef4444] rounded-md" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <div class="mt-4">
            <x-input-label for="role" :value="__('Register As')" class="text-white" />
            <select id="role" name="role" class="block mt-1 w-full bg-[#18181b] text-white border-[#ef4444] focus:border-[#ef4444] focus:ring-[#ef4444] rounded-md shadow-sm" required onchange="toggleFields()">
                <option value="" disabled selected>Select Role</option>
                <option value="employer">Employer</option>
                <option value="candidate">Candidate</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-500" />
        </div>

        <div class="mt-4 hidden" id="company_field">
            <x-input-label for="company_name" :value="__('Company Name (or Freelancer)')" class="text-white" />
            <x-text-input id="company_name" class="block mt-1 w-full bg-[#18181b] text-white border-[#ef4444] focus:border-[#ef4444] focus:ring-[#ef4444] rounded-md" type="text" name="company_name" :value="old('company_name')" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2 text-red-500" />
        </div>

        <div class="mt-4 hidden" id="resume_field">
            <x-input-label for="resume" :value="__('Upload CV (PDF)')" class="text-white" />
            <input id="resume" class="block mt-1 w-full bg-[#18181b] text-white border-[#ef4444] focus:border-[#ef4444] focus:ring-[#ef4444] rounded-md shadow-sm" type="file" name="resume" accept="application/pdf" />
            <x-input-error :messages="$errors->get('resume')" class="mt-2 text-red-500" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full bg-[#18181b] text-white border-[#ef4444] focus:border-[#ef4444] focus:ring-[#ef4444] rounded-md" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-[#18181b] text-white border-[#ef4444] focus:border-[#ef4444] focus:ring-[#ef4444] rounded-md" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <script>
            function toggleFields() {
                let role = document.getElementById('role').value;
                document.getElementById('company_field').classList.toggle('hidden', role !== 'employer');
                document.getElementById('resume_field').classList.toggle('hidden', role !== 'candidate');
            }
        </script>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-[#ef4444] hover:text-red-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ef4444]" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-3 bg-[#ef4444] hover:bg-red-600 text-white">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
