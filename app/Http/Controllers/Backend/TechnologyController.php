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
use App\Models\Technology;

class TechnologyController extends Controller
{

    public function index()
    {
        $technologies = Technology::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        return view('backend.campus.technology.index', compact('technologies'));
    }

    public function create(Request $request)
    {
        return view('backend.campus.technology.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'   => 'required|string|max:255',
                'image'            => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'  => 'required|string|max:255',
                'section_image'    => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'description'      => 'required|string|max:5000',
            ], [
                'banner_heading.required'  => 'Banner Heading is required.',
                'banner_heading.max'       => 'Banner Heading must not exceed 255 characters.',
                'image.required'           => 'Banner image is required.',
                'image.image'              => 'Please upload a valid Banner image.',
                'image.mimes'              => 'Banner image must be a file of type: jpg, jpeg, png, webp, svg.',
                'image.max'                => 'Banner image size must not exceed 2MB.',
                'section_heading.required' => 'Section Heading is required.',
                'section_heading.max'      => 'Section Heading must not exceed 255 characters.',
                'section_image.required'   => 'Section image is required.',
                'section_image.image'      => 'Please upload a valid Section image.',
                'section_image.mimes'      => 'Section image must be a file of type: jpg, jpeg, png, webp, svg.',
                'section_image.max'        => 'Section image size must not exceed 2MB.',
                'description.required'     => 'Description is required.',
                'description.max'          => 'Description must not exceed 5000 characters.',
            ]);

            // ✅ Handle banner image upload
            $bannerName = null;
            if ($request->hasFile('image')) {
                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/campus-life'), $bannerName);
            }

            // ✅ Handle section image upload
            $sectionImageName = null;
            if ($request->hasFile('section_image')) {
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(10, 999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/campus-life'), $sectionImageName);
            }

            // ✅ Save record to database
            $technology = new Technology();
            $technology->banner_heading  = $request->banner_heading;
            $technology->banner_image    = $bannerName;
            $technology->section_heading = $request->section_heading;
            $technology->section_image   = $sectionImageName;
            $technology->description     = $request->description;
            $technology->inserted_by     = Auth::id();
            $technology->inserted_at     = Carbon::now();
            $technology->save();

            return redirect()->route('manage-technology.index')
                            ->with('message', 'Technology record added successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; // Let Laravel handle validation errors

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $technology = Technology::findOrFail($id);
        return view('backend.campus.technology.edit', compact('technology'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the record
            $technology = Technology::findOrFail($id);

            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'   => 'required|string|max:255',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'  => 'required|string|max:255',
                'section_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'description'      => 'required|string|max:5000',
            ], [
                'banner_heading.required'  => 'Banner Heading is required.',
                'banner_heading.max'       => 'Banner Heading must not exceed 255 characters.',
                'image.image'              => 'Please upload a valid Banner image.',
                'image.mimes'              => 'Banner image must be a file of type: jpg, jpeg, png, webp, svg.',
                'image.max'                => 'Banner image size must not exceed 2MB.',
                'section_heading.required' => 'Section Heading is required.',
                'section_heading.max'      => 'Section Heading must not exceed 255 characters.',
                'section_image.image'      => 'Please upload a valid Section image.',
                'section_image.mimes'      => 'Section image must be a file of type: jpg, jpeg, png, webp, svg.',
                'section_image.max'        => 'Section image size must not exceed 2MB.',
                'description.required'     => 'Description is required.',
                'description.max'          => 'Description must not exceed 5000 characters.',
            ]);

            // ✅ Handle banner image upload (replace if new uploaded)
            if ($request->hasFile('image')) {
                // Delete old banner image if exists
                if ($technology->banner_image && file_exists(public_path('uploads/campus-life/' . $technology->banner_image))) {
                    unlink(public_path('uploads/campus-life/' . $technology->banner_image));
                }

                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/campus-life'), $bannerName);
                $technology->banner_image = $bannerName;
            }

            // ✅ Handle section image upload (replace if new uploaded)
            if ($request->hasFile('section_image')) {
                // Delete old section image if exists
                if ($technology->section_image && file_exists(public_path('uploads/campus-life/' . $technology->section_image))) {
                    unlink(public_path('uploads/campus-life/' . $technology->section_image));
                }

                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(10, 999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/campus-life'), $sectionImageName);
                $technology->section_image = $sectionImageName;
            }

            // ✅ Update other fields
            $technology->banner_heading  = $request->banner_heading;
            $technology->section_heading = $request->section_heading;
            $technology->description     = $request->description;
            $technology->modified_by     = Auth::id();
            $technology->modified_at     = Carbon::now();
            $technology->save();

            return redirect()->route('manage-technology.index')
                            ->with('message', 'Technology record updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; // Let Laravel handle validation errors

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Technology::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-technology.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}