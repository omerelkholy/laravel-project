<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CandidateProfile;
use App\Models\EmployerProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:employer,candidate'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'resume' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $user->assignRole($request->role);

        if ($request->role === 'employer') {
            $s =  EmployerProfile::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name ?? 'Freelancer',
            ]);
            if ($s) {
                $user->givePermissionTo(['create job', 'edit job', 'delete job']);
            }
        } elseif ($request->role === 'candidate') {
            $resumePath = null;

            if ($request->hasFile('resume')) {
                $resumeFile = $request->file('resume');

                Log::info('Uploaded file details:', [
                    'original_name' => $resumeFile->getClientOriginalName(),
                    'mime_type' => $resumeFile->getMimeType(),
                    'size' => $resumeFile->getSize(),
                ]);

                if (!$resumeFile->isValid()) {
                    Log::error('Uploaded file is not valid.');
                    return back()->withErrors(['resume' => 'File upload failed.']);
                }

                $resumeName = time() . '_' . $resumeFile->getClientOriginalName();
                $resumePath = $resumeFile->storeAs('resumes', $resumeName, 'public');

                Log::info('Resume uploaded successfully', ['path' => $resumePath]);
            } else {
                Log::error('Resume upload failed - No file detected');
                return back()->withErrors(['resume' => 'No resume file uploaded']);
            }

            CandidateProfile::create([
                'user_id' => $user->id,
                'resume' => $resumePath,
            ]);

            $user->givePermissionTo(['apply job']);
        }

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('job_listings.index', absolute: false));
    }
    public function deleteResume(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'candidate' && $user->candidate && $user->candidate->resume) {
            $resumePath = storage_path('app/public/' . $user->candidate->resume);

            if (file_exists($resumePath)) {
                unlink($resumePath);
            }

            $user->candidate->update(['resume' => null]);

            return back()->with('status', 'Resume deleted successfully.');
        }

        return back()->withErrors(['error' => 'No resume found to delete.']);
    }
}
