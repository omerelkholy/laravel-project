<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class JobListingController extends Controller
{
    public function index(Request $request)
    {

         if($request->filled('search')){
             $jobListings = JobListing::search($request->search)->get()->where('status', 'approved');
         }else{
            $jobListings = JobListing::approved()->get();
         }

        // Fetch approved job listings
        return view('job_listings.index', compact('jobListings'));
    }

    public function create()
    {
        // Show the form for creating a new job listing
        return view('job_listings.create');
    }

    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a job listing.');
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'benefits' => 'required|string',
            'salary_range' => 'required|string',
            'location' => 'required|string',
            'work_type' => 'required|in:remote,on_site,hybrid',
            'application_deadline' => 'required|date',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if($request->hasFile('company_logo')){
            $validatedData['company_logo']= $request->file('company_logo')->store('company_logo', 'public');
        }

        // Assign the user ID and set status to pending
        $validatedData['user_id'] = auth()->id();
        $validatedData['status'] = 'pending';

        // Log the incoming data for debugging
        Log::info('Creating Job Listing', $validatedData);

        // Create the job listing in the database
        JobListing::create($validatedData);

        // Redirect back with a success message
        return redirect()->route('job_listings.index')->with('success', 'Job listing created successfully.');
    }

    public function show(JobListing $jobListing)
    {
        // Abort if the job listing is not approved
        abort_if($jobListing->status !== 'approved', 404);

        // Show the job listing details
        return view('job_listings.show', compact('jobListing'));
    }

    public function edit(JobListing $jobListing)
    {
        // Check if the user is authorized to edit this job listing
    //    if ($jobListing->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
    //        abort(403);
    //    }

        return view('job_listings.edit', compact('jobListing'));
    }

    public function update(Request $request, JobListing $jobListing)
    {
        // Check if the user is authorized to update this job listing
        // if ($jobListing->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
        //     abort(403);
        // }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'benefits' => 'required|string',
            'salary_range' => 'required|string',
            'location' => 'required|string',
            'work_type' => 'required|in:remote,on_site,hybrid',
            'application_deadline' => 'required|date',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('company_logo')) {
            if($jobListing->company_logo) {
                Storage::disk('public')->delete($jobListing->company_logo);
            }
            $validatedData['company_logo'] = $request->file('company_logo')->store('company_logo', 'public');
        } else {
            unset($validatedData['company_logo']);
        }


        // Update the job listing in the database
        $jobListing->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('job_listings.index')->with('success', 'Job listing updated successfully.');
    }

    public function destroy(JobListing $jobListing)
    {
        // Check if the user is authorized to delete this job listing
//        if ($jobListing->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
//            abort(403);
//        }

        // Delete the job listing from the database
        $jobListing->delete();

        // Redirect back with a success message
        return redirect()->route('job_listings.index')->with('success', 'Job listing deleted successfully.');
    }
}



