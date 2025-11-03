<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


use Carbon\Carbon;
use App\Models\User;
use App\Models\JobPosting;
use App\Models\Career;

class JobPostingController extends Controller
{

    public function index()
    {
        // Get all job postings
        $jobPostings = JobPosting::wherenull('deleted_by')->get(); // Assuming your model is JobPosting

        // dd($jobPostings);
        // Fetch categories from Career table
        $career = Career::first();

        $jobCategories = [];
        if ($career && $career->teaching_details) {
            $decoded = json_decode($career->teaching_details, true);

            foreach ($decoded as $index => $item) {
                $jobCategories[] = [
                    'id' => $index + 1,
                    'title' => $item['title'],
                    'image' => $item['image'],
                ];
            }
        }

        return view('backend.careers.jobs_posting.index', compact('jobCategories', 'jobPostings'));
    }

    public function create()
    {
        $career = Career::first();

        $jobCategories = [];
        if ($career && $career->teaching_details) {
            $decoded = json_decode($career->teaching_details, true);

            // Add IDs starting from 1
            foreach ($decoded as $index => $item) {
                $jobCategories[] = [
                    'id' => $index + 1,
                    'title' => $item['title'],
                    'image' => $item['image']
                ];
            }
        }

        return view('backend.careers.jobs_posting.create', compact('jobCategories'));
    }

    public function store(Request $request)
    {
        try {
        // ✅ Step 1: Validate the input
                $career = Career::first();

        $validCategories = [];

        if ($career && $career->teaching_details) {
            $decoded = json_decode($career->teaching_details, true);

            if (is_array($decoded)) {
                foreach ($decoded as $index => $item) {
                    $validCategories[$index + 1] = $item['title'];
                }
            }
        }

        $validatedData = $request->validate([
            'job_category' => [
                'required',
                function ($attribute, $value, $fail) use ($validCategories) {
                    if (!array_key_exists($value, $validCategories)) {
                        $fail('The selected job category is invalid.');
                    }
                },
            ],
            'job_role' => 'required|string|max:255',
        ], [
            'job_category.required' => 'Please select a job category.',
            'job_role.required' => 'Please enter a job role.',
        ]);

            // ✅ Step 2: Save to database
            $jobPosting = new JobPosting();
            $jobPosting->job_category_id = $validatedData['job_category'];
            $jobPosting->job_roles = $validatedData['job_role'];
            $jobPosting->inserted_by        = Auth::id();
            $jobPosting->inserted_at        = Carbon::now();
            $jobPosting->save();

            // ✅ Step 3: Redirect with success message
            return redirect()->route('manage-job-postings.index')
                            ->with('message', 'Job posting created successfully.');

        } catch (\Exception $e) {

            return back()->with('error', 'Something went wrong: ' . $e->getMessage())
                        ->withInput();
        }

    }

    public function edit($id)
    {
        $opportunities = JobPosting::findOrFail($id);

        $career = Career::first();

        $jobCategories = [];
        if ($career && $career->teaching_details) {
            $decoded = json_decode($career->teaching_details, true);

            // Add IDs starting from 1
            foreach ($decoded as $index => $item) {
                $jobCategories[] = [
                    'id' => $index + 1,
                    'title' => $item['title'],
                    'image' => $item['image']
                ];
            }
        }

        return view('backend.careers.jobs_posting.edit', compact('opportunities','jobCategories'));
    }

    public function update(Request $request, $id)
    {
        try {
            // ✅ Step 1: Fetch Career and prepare valid categories
            $career = Career::first();
            $validCategories = [];

            if ($career && $career->teaching_details) {
                $decoded = json_decode($career->teaching_details, true);

                if (is_array($decoded)) {
                    foreach ($decoded as $index => $item) {
                        $validCategories[$index + 1] = $item['title'];
                    }
                }
            }

            // ✅ Step 2: Validate incoming data
            $validatedData = $request->validate([
                'job_category' => [
                    'required',
                    function ($attribute, $value, $fail) use ($validCategories) {
                        if (!array_key_exists($value, $validCategories)) {
                            $fail('The selected job category is invalid.');
                        }
                    },
                ],
                'job_role' => 'required|string|max:255',
            ], [
                'job_category.required' => 'Please select a job category.',
                'job_role.required' => 'Please enter a job role.',
            ]);

            // ✅ Step 3: Find the record and update
            $jobPosting = JobPosting::findOrFail($id);
            $jobPosting->job_category_id = $validatedData['job_category'];
            $jobPosting->job_roles = $validatedData['job_role'];
            $jobPosting->modified_by = Auth::id();
            $jobPosting->modified_at = Carbon::now();
            $jobPosting->save();

            // ✅ Step 4: Redirect with success message
            return redirect()->route('manage-job-postings.index')
                            ->with('message', 'Job posting updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = JobPosting::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-job-postings.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}