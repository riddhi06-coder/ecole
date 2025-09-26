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

use Carbon\Carbon;
use App\Models\User;
use App\Models\SchoolCalendar;

class SchoolCalendarController extends Controller
{

    
    public function index()
    {
        $records = SchoolCalendar::wherenull('deleted_by')->get();
        return view('backend.about.school_calendar.index', compact('records'));
    }

    public function create(Request $request)
    {
        return view('backend.about.school_calendar.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        // ✅ Validate inputs
        $validatedData = $request->validate([
            'thumbnail'           => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'      => 'required|string|max:255',
            'section_image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'     => 'required|string|max:255',
            'section_description' => 'required|string',
            'years.*'             => ['required', 'regex:/^[0-9\/]+$/'],
            'documents.*'         => 'required|mimes:pdf,doc,docx|max:2048',
        ], [
            'thumbnail.required' => 'Please upload a Banner image.',
            'banner_heading.required' => 'Please enter a Banner heading.',
            'section_image.required' => 'Please upload a Section image.',
            'section_heading.required' => 'Please enter Section heading.',
            'section_description.required' => 'Please enter Section description.',
            'years.*.required' => 'Please enter year(s).',
            'years.*.regex' => 'Year format is invalid. Use numbers or slashes (e.g., 2024/2015).',
            'documents.*.required' => 'Please upload a document.',
            'documents.*.mimes' => 'Only PDF or Word documents are allowed.',
        ]);

        // ✅ Handle file uploads (Banner & Section)
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerImage);
        }

        $sectionImage = null;
        if ($request->hasFile('section_image')) {
            $image = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage);
        }

        // ✅ Handle yearly documents
        $yearlyDocuments = [];
        if ($request->has('years') && $request->hasFile('documents')) {
            foreach ($request->years as $index => $year) {
                $docName = null;
                if ($request->file('documents')[$index]) {
                    $doc = $request->file('documents')[$index];
                    $docName = time() . rand(10, 999) . '.' . $doc->getClientOriginalExtension();
                    $doc->move(public_path('uploads/about'), $docName);
                }

                $yearlyDocuments[] = [
                    'year' => $year,
                    'document' => $docName,
                ];
            }
        }

        // ✅ Save data to DB
        $schoolCalendar = new SchoolCalendar();
        $schoolCalendar->banner_image = $bannerImage;
        $schoolCalendar->banner_heading = $validatedData['banner_heading'];
        $schoolCalendar->section_image = $sectionImage;
        $schoolCalendar->section_heading = $validatedData['section_heading'];
        $schoolCalendar->section_description = $validatedData['section_description'];
        $schoolCalendar->yearly_documents = json_encode($yearlyDocuments); 
        $schoolCalendar->inserted_by = Auth::id();
        $schoolCalendar->inserted_at = Carbon::now();
        $schoolCalendar->save();

        return redirect()->route('manage-school-calendar.index')->with('message', 'School Calendar added successfully.');
    }

    public function edit($id)
    {
        $set_apart = SchoolCalendar::findOrFail($id);
        $yearlyDocuments = json_decode($set_apart->yearly_documents, true) ?? [];

        return view('backend.about.school_calendar.edit', compact('set_apart', 'yearlyDocuments'));
    }

    public function update(Request $request, $id)
    {
        $schoolCalendar = SchoolCalendar::findOrFail($id);

        // ✅ Validate inputs
        $validatedData = $request->validate([
            'thumbnail'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'      => 'required|string|max:255',
            'section_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'     => 'required|string|max:255',
            'section_description' => 'required|string',
            'years.*'             => ['required', 'regex:/^[0-9\/]+$/'],
            'documents.*'         => 'nullable|mimes:pdf,doc,docx|max:2048',
        ], [
            'banner_heading.required' => 'Please enter a Banner heading.',
            'section_heading.required' => 'Please enter Section heading.',
            'section_description.required' => 'Please enter Section description.',
            'years.*.required' => 'Please enter year(s).',
            'years.*.regex' => 'Year format is invalid. Use numbers or slashes (e.g., 2024/2015).',
            'documents.*.mimes' => 'Only PDF or Word documents are allowed.',
        ]);

        // ✅ Update Banner Image if new uploaded
        if ($request->hasFile('thumbnail')) {
            // Delete old file
            if ($schoolCalendar->banner_image && file_exists(public_path('uploads/about/' . $schoolCalendar->banner_image))) {
                unlink(public_path('uploads/about/' . $schoolCalendar->banner_image));
            }
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerImage);
            $schoolCalendar->banner_image = $bannerImage;
        }

        // ✅ Update Section Image if new uploaded
        if ($request->hasFile('section_image')) {
            // Delete old file
            if ($schoolCalendar->section_image && file_exists(public_path('uploads/about/' . $schoolCalendar->section_image))) {
                unlink(public_path('uploads/about/' . $schoolCalendar->section_image));
            }
            $image = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage);
            $schoolCalendar->section_image = $sectionImage;
        }

        // ✅ Handle Yearly Documents
        $existingDocuments = json_decode($schoolCalendar->yearly_documents, true) ?? [];
        $yearlyDocuments = [];

        foreach ($request->years as $index => $year) {
            $docName = $existingDocuments[$index]['document'] ?? null;

            // Replace document if a new file uploaded
            if ($request->hasFile('documents') && isset($request->file('documents')[$index])) {
                // Delete old file
                if ($docName && file_exists(public_path('uploads/about/' . $docName))) {
                    unlink(public_path('uploads/about/' . $docName));
                }
                $doc = $request->file('documents')[$index];
                $docName = time() . rand(10, 999) . '.' . $doc->getClientOriginalExtension();
                $doc->move(public_path('uploads/about'), $docName);
            }

            $yearlyDocuments[] = [
                'year' => $year,
                'document' => $docName,
            ];
        }

        // ✅ Update DB
        $schoolCalendar->banner_heading = $validatedData['banner_heading'];
        $schoolCalendar->section_heading = $validatedData['section_heading'];
        $schoolCalendar->section_description = $validatedData['section_description'];
        $schoolCalendar->yearly_documents = json_encode($yearlyDocuments);
        $schoolCalendar->modified_by = Auth::id();
        $schoolCalendar->modified_at = Carbon::now();
        $schoolCalendar->save();

        return redirect()->route('manage-school-calendar.index')->with('message', 'School Calendar updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = SchoolCalendar::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-school-calendar.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}