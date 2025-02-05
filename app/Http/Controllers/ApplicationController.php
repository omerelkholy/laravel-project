<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
// use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Exception;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $jobListings = $request->user()->jobListings;

        return view("applications", compact('jobListings'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(JobListing $jobListing)
    {
        return view('job_listings.apply', ['jobId' => $jobListing->id]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'time' => 'required',
            'price' => 'required|numeric',
            'offer_description' => 'required|string|max:500',
            'job_id' => 'required|exists:job_listings,id', // Ensure the job exists
        ]);


        // Create offer with authenticated user's ID as candidate_id
        Application::create([
            'time' => $validated['time'],
            'price' => $validated['price'],
            'description' => $validated['offer_description'],
            'job_listing_id' => $validated['job_id'],
            'user_id' => auth()->id(), // Get candidate ID from auth
        ]);

        // Redirect with success message
        return redirect()->route('job_listings.index')
            ->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    public function approve(Request $request, Application $application)
    {
        //
        try {
            $application->status = "accepted";
            $application->save();
        } catch (Exception $e) {
            return back()->with(["error" => $e]);
        }
        return back()->with(["success" => true]);
    }
    public function reject(Request $request, Application $application)
    {
        //
        try {
            $application->status = "rejected";
            $application->save();
        } catch (Exception $e) {
            return back()->with(["error" => $e]);
        }
        return back()->with(["success" => true]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
