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
use App\Models\ManageLearnerProfile;

class LearnerProfileController extends Controller
{

    public function index()
    {
        $ib_learner = ManageLearnerProfile::wherenull('deleted_by')->get();
        return view('backend.academics.ib_learner.index', compact('ib_learner'));
    }

    public function create(Request $request)
    {
        return view('backend.academics.ib_learner.create');
    }

    public function store(Request $request){

        try {
            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'      => 'nullable|string|max:255',
                'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'     => 'nullable|string|max:255',
                'section_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_description' => 'nullable|string',
                'title'               => 'required|string|max:255',
                'description'         => 'required|string',
            ], [
                'banner_heading.string'      => 'Banner heading must be a string.',
                'image.image'                => 'The banner must be an image file.',
                'image.mimes'                => 'Allowed banner formats: jpg, jpeg, png, webp, svg.',
                'image.max'                  => 'Banner image size must be less than 2MB.',
                'section_heading.string'     => 'Section heading must be a string.',
                'section_image.image'        => 'The section image must be a valid image file.',
                'section_image.mimes'        => 'Allowed section image formats: jpg, jpeg, png, webp, svg.',
                'section_image.max'          => 'Section image size must be less than 2MB.',
                'title.required'             => 'Title is required.',
                'description.required'       => 'Description is required.',
            ]);


            // ✅ Handle Banner Image Upload
            $bannerName = null;
            if ($request->hasFile('image')) {
                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/academics'), $bannerName);
                Log::info('Banner image uploaded', ['banner' => $bannerName]);
            }

            // ✅ Handle Section Image Upload
            $sectionImageName = null;
            if ($request->hasFile('section_image')) {
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(1000, 9999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/academics'), $sectionImageName);
                Log::info('Section image uploaded', ['section_image' => $sectionImageName]);
            }

            // ✅ Store in Database
            $learnerProfile = new ManageLearnerProfile();
            $learnerProfile->banner_heading      = $validated['banner_heading'] ?? null;
            $learnerProfile->banner_image        = $bannerName ?? null;
            $learnerProfile->section_heading     = $validated['section_heading'] ?? null;
            $learnerProfile->section_image       = $sectionImageName ?? null;
            $learnerProfile->section_description = $validated['section_description'] ?? null;
            $learnerProfile->title               = $validated['title'];
            $learnerProfile->description         = $validated['description'];
            $learnerProfile->inserted_by         = Auth::id();
            $learnerProfile->inserted_at         = Carbon::now();
            $learnerProfile->save();


            // ✅ Success Message
            return redirect()->route('manage-learner-profile.index')
                ->with('message', 'Learner Profile section added successfully!');

        } catch (\Exception $e) {
            // ❌ Error Handling & Logging
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $ib_learner = ManageLearnerProfile::findOrFail($id);
        return view('backend.academics.ib_learner.edit', compact('ib_learner'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the record
            $learnerProfile = ManageLearnerProfile::findOrFail($id);
            Log::info('ManageLearnerProfile update called', ['id' => $id, 'request' => $request->all()]);

            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'      => 'nullable|string|max:255',
                'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'     => 'nullable|string|max:255',
                'section_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_description' => 'nullable|string',
                'title'               => 'required|string|max:255',
                'description'         => 'required|string',
            ], [
                'banner_heading.string'      => 'Banner heading must be a string.',
                'image.image'                => 'The banner must be an image file.',
                'image.mimes'                => 'Allowed banner formats: jpg, jpeg, png, webp, svg.',
                'image.max'                  => 'Banner image size must be less than 2MB.',
                'section_heading.string'     => 'Section heading must be a string.',
                'section_image.image'        => 'The section image must be a valid image file.',
                'section_image.mimes'        => 'Allowed section image formats: jpg, jpeg, png, webp, svg.',
                'section_image.max'          => 'Section image size must be less than 2MB.',
                'title.required'             => 'Title is required.',
                'description.required'       => 'Description is required.',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            // ✅ Handle Banner Image Upload
            if ($request->hasFile('image')) {
                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/academics'), $bannerName);
                $learnerProfile->banner_image = $bannerName;
                Log::info('Banner image updated', ['banner' => $bannerName]);
            }

            // ✅ Handle Section Image Upload
            if ($request->hasFile('section_image')) {
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(1000, 9999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/academics'), $sectionImageName);
                $learnerProfile->section_image = $sectionImageName;
                Log::info('Section image updated', ['section_image' => $sectionImageName]);
            }

            // ✅ Update other fields
            $learnerProfile->banner_heading      = $validated['banner_heading'] ?? $learnerProfile->banner_heading;
            $learnerProfile->section_heading     = $validated['section_heading'] ?? $learnerProfile->section_heading;
            $learnerProfile->section_description = $validated['section_description'] ?? $learnerProfile->section_description;
            $learnerProfile->title               = $validated['title'];
            $learnerProfile->description         = $validated['description'];
            $learnerProfile->modified_by          = Auth::id();
            $learnerProfile->modified_at          = Carbon::now();
            $learnerProfile->save();

            Log::info('LearnerProfile updated successfully', ['id' => $id]);

            return redirect()->route('manage-learner-profile.index')
                ->with('message', 'Learner Profile section updated successfully!');

        } catch (\Exception $e) {
            Log::error('Error updating LearnerProfile', ['message' => $e->getMessage(), 'id' => $id]);
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ManageLearnerProfile::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-learner-profile.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
    
}