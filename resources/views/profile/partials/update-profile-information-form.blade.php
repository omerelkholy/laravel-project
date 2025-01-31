<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
<div>
    <x-input-label for="profile_image" :value="__('Profile Image')" />
    <input id="profile_image" name="profile_image" type="file" class="mt-1 block w-full" accept="image/*" />
    @if($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}" class="mt-2 w-24 h-24 rounded-full" alt="Profile Image">
    @endif
</div>

<div>
    <x-input-label for="phone" :value="__('Phone Number')" />
    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
</div>

@if($user->role === 'candidate')
    <div>
        <x-input-label for="bio" :value="__('Bio')" />
        <textarea id="bio" name="bio" class="mt-1 block w-full">{{ old('bio', $user->candidate->bio) }}</textarea>
    </div>
@endif
<br>
@if($user->role === 'candidate' && $user->candidate->resume)
    <div>
        <p class="text-sm text-gray-500">Current Resume: 
            <a href="{{ asset('storage/' . $user->candidate->resume) }}" class="text-blue-500 underline" target="_blank">View Resume</a>
        </p>

    
    </div>
@endif

<br>
        @if($user->role === 'employer')
            <div>
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', $user->employer->company_name ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
            </div>
        @endif

        @if($user->role === 'candidate')
            <div>
                <x-input-label for="resume" :value="__('Upload New Resume (PDF)')" />
                <input id="resume" name="resume" type="file" class="mt-1 block w-full" accept="application/pdf" />
                <x-input-error class="mt-2" :messages="$errors->get('resume')" />

            </div>
        @endif
<br>
        <div class="flex items-center gap-4">
            
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            
            
            @if (session('status') === 'profile-updated')
           <a href="{{ route('profile.update') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                {{ __('save') }}
            </a>
            @endif
            
            <a href="{{ route('profile') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                {{ __('Cancel') }}
            </a>
</div>

    </form>
</section>
