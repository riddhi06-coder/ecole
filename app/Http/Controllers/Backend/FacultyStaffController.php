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
use App\Models\FacultyStaff;

class FacultyStaffController extends Controller
{

    public function index()
    {
        $records = FacultyStaff::wherenull('deleted_by')->get();
        return view('backend.about.faculty.index', compact('records'));
    }

    public function create(Request $request)
    {
        return view('backend.about.faculty.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate inputs
        $validatedData = $request->validate([
            'thumbnail'           => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'      => 'required|string|max:255',
            'section_image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'     => 'required|string|max:255',
            'section_description' => 'required|string',
            'extra_image'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'extra_description'   => 'required|string',
        ], [
            'thumbnail.required' => 'Please upload a Banner image.',
            'banner_heading.required' => 'Please enter a Banner heading.',
            'section_image.required' => 'Please upload a Section image.',
            'section_heading.required' => 'Please enter Section heading.',
            'section_description.required' => 'Please enter Section description.',
            'extra_image.required' => 'Please upload an Additional image.',
            'extra_description.required' => 'Please enter Additional description.',
        ]);

        // ✅ Handle file uploads (using your method)
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

        $extraImage = null;
        if ($request->hasFile('extra_image')) {
            $image = $request->file('extra_image');
            $extraImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $extraImage);
        }

        // ✅ Save data to DB
        $facultyStaff = new FacultyStaff();
        $facultyStaff->banner_image           = $bannerImage;
        $facultyStaff->banner_heading      = $validatedData['banner_heading'];
        $facultyStaff->section_image       = $sectionImage;
        $facultyStaff->section_heading     = $validatedData['section_heading'];
        $facultyStaff->section_description = $validatedData['section_description'];
        $facultyStaff->extra_image         = $extraImage;
        $facultyStaff->extra_description   = $validatedData['extra_description'];
        $facultyStaff->save();

        return redirect()->route('manage-faculty-and-staff.index')->with('message', 'Faculty & Staff details added successfully.');
    }

    public function edit($id)
    {
        $set_apart = FacultyStaff::findOrFail($id);
        return view('backend.about.faculty.edit', compact('set_apart'));
    }


    public function update(Request $request, $id)
    {
        // ✅ Validate inputs
        $validatedData = $request->validate([
            'thumbnail'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'      => 'required|string|max:255',
            'section_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'     => 'required|string|max:255',
            'section_description' => 'required|string',
            'extra_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'extra_description'   => 'required|string',
        ], [
            'banner_heading.required' => 'Please enter a Banner heading.',
            'section_heading.required' => 'Please enter Section heading.',
            'section_description.required' => 'Please enter Section description.',
            'extra_description.required' => 'Please enter Additional description.',
        ]);

        // ✅ Find record
        $facultyStaff = FacultyStaff::findOrFail($id);

        // ✅ Handle file uploads
        if ($request->hasFile('thumbnail')) {
            // delete old file if exists
            if ($facultyStaff->banner_image && file_exists(public_path('uploads/about/' . $facultyStaff->banner_image))) {
                unlink(public_path('uploads/about/' . $facultyStaff->banner_image));
            }

            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerImage);
            $facultyStaff->banner_image = $bannerImage;
        }

        if ($request->hasFile('section_image')) {
            if ($facultyStaff->section_image && file_exists(public_path('uploads/about/' . $facultyStaff->section_image))) {
                unlink(public_path('uploads/about/' . $facultyStaff->section_image));
            }

            $image = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage);
            $facultyStaff->section_image = $sectionImage;
        }

        if ($request->hasFile('extra_image')) {
            if ($facultyStaff->extra_image && file_exists(public_path('uploads/about/' . $facultyStaff->extra_image))) {
                unlink(public_path('uploads/about/' . $facultyStaff->extra_image));
            }

            $image = $request->file('extra_image');
            $extraImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $extraImage);
            $facultyStaff->extra_image = $extraImage;
        }

        // ✅ Update text fields
        $facultyStaff->banner_heading      = $validatedData['banner_heading'];
        $facultyStaff->section_heading     = $validatedData['section_heading'];
        $facultyStaff->section_description = $validatedData['section_description'];
        $facultyStaff->extra_description   = $validatedData['extra_description'];
        $facultyStaff->modified_by = Auth::id();
        $facultyStaff->modified_at = Carbon::now();

        $facultyStaff->save();

        return redirect()->route('manage-faculty-and-staff.index')->with('message', 'Faculty & Staff details updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = FacultyStaff::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-faculty-and-staff.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}