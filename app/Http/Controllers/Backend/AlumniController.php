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
use App\Models\AboutAlumni;

class AlumniController extends Controller
{

    public function index()
    {
        $alumni = AboutAlumni::wherenull('deleted_by')->get();
        return view('backend.about.alumni.index', compact('alumni'));
    }

    public function create(Request $request)
    {
        return view('backend.about.alumni.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation Rules
        $validatedData = $request->validate([
            'thumbnail'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'     => 'nullable|string|max:255',
            'alumni_email'       => 'nullable|email|max:255',
            'alumni_image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alumni_name'        => 'required|string|max:255',
            'alumni_desc'        => 'required|string|max:500',
            'section_description'=> 'required|string',
        ], [
            'thumbnail.image'        => 'The banner image must be an image file.',
            'thumbnail.mimes'        => 'The banner image must be a file of type: jpg, jpeg, png, webp.',
            'thumbnail.max'          => 'The banner image must not exceed 2MB.',

            'alumni_email.email'     => 'Please enter a valid alumni email.',

            'alumni_image.required'  => 'The alumni image is required.',
            'alumni_image.image'     => 'The alumni image must be an image file.',
            'alumni_image.mimes'     => 'The alumni image must be a file of type: jpg, jpeg, png, webp.',
            'alumni_image.max'       => 'The alumni image must not exceed 2MB.',

            'alumni_name.required'   => 'The alumni name is required.',
            'alumni_desc.required'   => 'The alumni description is required.',
            'section_description.required' => 'The section description is required.',
        ]);

        // ✅ Handle Thumbnail Upload
        $thumbnailImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $thumbnailImage = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $thumbnailImage);
        }

        // ✅ Handle Alumni Image Upload
        $alumniImage = null;
        if ($request->hasFile('alumni_image')) {
            $image = $request->file('alumni_image');
            $alumniImage = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $alumniImage);
        }

        // ✅ Save Data
        $aboutAlumni = new AboutAlumni();
        $aboutAlumni->banner_image = $thumbnailImage;
        $aboutAlumni->banner_heading = $validatedData['banner_heading'] ?? null;
        $aboutAlumni->alumni_email = $validatedData['alumni_email'] ?? null;
        $aboutAlumni->alumni_image = $alumniImage;
        $aboutAlumni->alumni_name = $validatedData['alumni_name'];
        $aboutAlumni->alumni_desc = $validatedData['alumni_desc'];
        $aboutAlumni->section_description = $validatedData['section_description'];
        $aboutAlumni->inserted_by = Auth::id();
        $aboutAlumni->inserted_at = Carbon::now();
        $aboutAlumni->save();

        return redirect()->route('manage-about-alumni.index')->with('message', 'Alumni details have been added successfully!');
    }

    public function edit($id)
    {
        $alumni = AboutAlumni::findOrFail($id);
        return view('backend.about.alumni.edit', compact('alumni'));
    }


    public function update(Request $request, $id)
    {
        $alumni = AboutAlumni::findOrFail($id);

        // ✅ Validation Rules
        $validatedData = $request->validate([
            'thumbnail'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'     => 'nullable|string|max:255',
            'alumni_email'       => 'nullable|email|max:255',
            'alumni_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // optional here
            'alumni_name'        => 'required|string|max:255',
            'alumni_desc'        => 'required|string|max:500',
            'section_description'=> 'required|string',
        ], [
            'thumbnail.image'        => 'The banner image must be an image file.',
            'thumbnail.mimes'        => 'The banner image must be a file of type: jpg, jpeg, png, webp.',
            'thumbnail.max'          => 'The banner image must not exceed 2MB.',

            'alumni_email.email'     => 'Please enter a valid alumni email.',

            'alumni_image.image'     => 'The alumni image must be an image file.',
            'alumni_image.mimes'     => 'The alumni image must be a file of type: jpg, jpeg, png, webp.',
            'alumni_image.max'       => 'The alumni image must not exceed 2MB.',

            'alumni_name.required'   => 'The alumni name is required.',
            'alumni_desc.required'   => 'The alumni description is required.',
            'section_description.required' => 'The section description is required.',
        ]);

        // ✅ Handle Thumbnail Upload (Replace Old)
        if ($request->hasFile('thumbnail')) {
            if ($alumni->banner_image && file_exists(public_path('uploads/about/' . $alumni->banner_image))) {
                unlink(public_path('uploads/about/' . $alumni->banner_image));
            }

            $image = $request->file('thumbnail');
            $thumbnailImage = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $thumbnailImage);
            $alumni->banner_image = $thumbnailImage;
        }

        // ✅ Handle Alumni Image Upload (Replace Old)
        if ($request->hasFile('alumni_image')) {
            if ($alumni->alumni_image && file_exists(public_path('uploads/about/' . $alumni->alumni_image))) {
                unlink(public_path('uploads/about/' . $alumni->alumni_image));
            }

            $image = $request->file('alumni_image');
            $alumniImage = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $alumniImage);
            $alumni->alumni_image = $alumniImage;
        }

        // ✅ Update Other Fields
        $alumni->banner_heading = $validatedData['banner_heading'] ?? null;
        $alumni->alumni_email = $validatedData['alumni_email'] ?? null;
        $alumni->alumni_name = $validatedData['alumni_name'];
        $alumni->alumni_desc = $validatedData['alumni_desc'];
        $alumni->section_description = $validatedData['section_description'];
        $alumni->modified_by = Auth::id();
        $alumni->modified_at = Carbon::now();
        $alumni->save();

        return redirect()->route('manage-about-alumni.index')->with('message', 'Alumni details have been updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = AboutAlumni::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-about-alumni.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}