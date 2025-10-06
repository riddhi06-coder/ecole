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
use App\Models\ManageTeachingJob;

class TeachingJobsController extends Controller
{

    public function index()
    {
        $teaching = ManageTeachingJob::orderBy('id', 'asc')->wherenull('deleted_by')->get();
        return view('backend.careers.opportunities.teaching.index', compact('teaching'));
    }

    public function create(Request $request)
    {
        return view('backend.careers.opportunities.teaching.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'  => 'required|string|max:255',
                'image'           => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading' => 'required|string|max:255',
                'section_image'   => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'description'     => 'required|string',
            ], [
                'banner_heading.required'  => 'Banner heading is required.',
                'image.required'           => 'A banner image is required.',
                'image.image'              => 'The banner must be an image file.',
                'image.mimes'              => 'Allowed banner formats: jpg, jpeg, png, webp, svg.',
                'image.max'                => 'Banner image size must be less than 2MB.',
                'section_heading.required' => 'Section heading is required.',
                'section_image.required'   => 'A section image is required.',
                'section_image.image'      => 'The section image must be a valid image file.',
                'section_image.mimes'      => 'Allowed section image formats: jpg, jpeg, png, webp, svg.',
                'section_image.max'        => 'Section image size must be less than 2MB.',
                'description.required'     => 'Description is required.',
            ]);

            // ✅ Handle Banner Image Upload
            $bannerName = null;
            if ($request->hasFile('image')) {
                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/careers'), $bannerName);
            }

            // ✅ Handle Section Image Upload
            $sectionImageName = null;
            if ($request->hasFile('section_image')) {
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(1000, 9999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/careers'), $sectionImageName);
            }

            // ✅ Store in Database
            $teachingJob = new ManageTeachingJob();
            $teachingJob->banner_heading  = $validated['banner_heading'];
            $teachingJob->banner_image    = $bannerName;
            $teachingJob->section_heading = $validated['section_heading'];
            $teachingJob->section_image   = $sectionImageName;
            $teachingJob->description     = $validated['description'];
            $teachingJob->inserted_by      = Auth::id();
            $teachingJob->inserted_at      = Carbon::now();
            $teachingJob->save();

            // ✅ Success Message
            return redirect()->route('manage-teaching-jobs.index')
                ->with('message', 'Teaching Job section added successfully!');

        } catch (\Exception $e) {
            // ❌ Error Handling
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }
 
    public function edit($id)
    {
        $teaching = ManageTeachingJob::findOrFail($id);
        return view('backend.careers.opportunities.teaching.edit', compact('teaching'));
    }

    public function update(Request $request, $id)
    {
        try {
            // ✅ Find record
            $teachingJob = ManageTeachingJob::findOrFail($id);

            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'  => 'required|string|max:255',
                'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading' => 'required|string|max:255',
                'section_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'description'     => 'required|string',
            ], [
                'banner_heading.required'  => 'Banner heading is required.',
                'image.image'              => 'The banner must be an image file.',
                'image.mimes'              => 'Allowed banner formats: jpg, jpeg, png, webp, svg.',
                'image.max'                => 'Banner image size must be less than 2MB.',
                'section_heading.required' => 'Section heading is required.',
                'section_image.image'      => 'The section image must be a valid image file.',
                'section_image.mimes'      => 'Allowed section image formats: jpg, jpeg, png, webp, svg.',
                'section_image.max'        => 'Section image size must be less than 2MB.',
                'description.required'     => 'Description is required.',
            ]);

            // ✅ Handle Banner Image (if new file uploaded)
            if ($request->hasFile('image')) {
                // Delete old file if exists
                $oldBanner = public_path('uploads/careers/' . $teachingJob->banner_image);
                if (file_exists($oldBanner) && is_file($oldBanner)) {
                    unlink($oldBanner);
                }

                // Upload new image
                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/careers'), $bannerName);

                $teachingJob->banner_image = $bannerName;
            }

            // ✅ Handle Section Image (if new file uploaded)
            if ($request->hasFile('section_image')) {
                // Delete old file if exists
                $oldSection = public_path('uploads/careers/' . $teachingJob->section_image);
                if (file_exists($oldSection) && is_file($oldSection)) {
                    unlink($oldSection);
                }

                // Upload new image
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(1000, 9999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/careers'), $sectionImageName);

                $teachingJob->section_image = $sectionImageName;
            }

            // ✅ Update remaining fields
            $teachingJob->banner_heading  = $validated['banner_heading'];
            $teachingJob->section_heading = $validated['section_heading'];
            $teachingJob->description     = $validated['description'];
            $teachingJob->modified_by      = Auth::id();
            $teachingJob->modified_at      = Carbon::now();

            $teachingJob->save();

            // ✅ Success Message
            return redirect()->route('manage-teaching-jobs.index')
                ->with('message', 'Teaching Job section updated successfully!');

        } catch (\Exception $e) {
            // ❌ Error Handling
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ManageTeachingJob::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-teaching-jobs.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}