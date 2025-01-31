<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:15'],
            'profile_image' => ['nullable', 'image', 'max:2048'], 
            'company_name' => ['nullable', 'string', 'max:255'], 
            'resume' => ['nullable', 'file', 'mimes:pdf', 'max:2048'], 
            'bio' => ['nullable', 'string', 'max:1000'], 
        ]);
    
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null,
        ]);
    
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->update(['profile_image' => $profileImagePath]);
        }
    
        if ($user->role === 'employer') {
            $user->employer()->update(['company_name' => $validatedData['company_name'] ?? 'Freelancer']);
        }
    
        if ($user->role === 'candidate') {
            $candidate = $user->candidate;
            
            if ($request->hasFile('resume')) {
                if ($candidate->resume) {
                    Storage::delete('public/' . $candidate->resume);
                }
                $resumePath = $request->file('resume')->store('resumes', 'public');
                $candidate->update(['resume' => $resumePath]);
            }
    
            $candidate->update(['bio' => $validatedData['bio'] ?? null]);
        }
    
        return Redirect::route('profile')->with('status', 'profile-updated');
    }
    
    

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show()
{
    return view('profile.profile', ['user' => Auth::user()]);
}

}
