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
use App\Models\IBVisual;

class PerformingArtsController extends Controller
{

    public function index()
    {
        $performings = IBVisual::orderBy('id', 'asc')->wherenull('deleted_by')->get(); 
        return view('backend.campus.performing.index', compact('performings'));
    }

    public function create(Request $request)
    {
        return view('backend.campus.performing.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'   => 'nullable|string|max:255',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'  => 'nullable|string|max:255',
                'section_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'title'            => 'required|string|max:255',
                'description'      => 'required|string|max:5000',
            ], [
                'banner_heading.max'   => 'Banner Heading must not exceed 255 characters.',
                'image.image'          => 'Please upload a valid Banner image.',
                'image.mimes'          => 'Banner image must be a file of type: jpg, jpeg, png, webp, svg.',
                'image.max'            => 'Banner image size must not exceed 2MB.',
                'section_heading.max'  => 'Section Heading must not exceed 255 characters.',
                'section_image.image'  => 'Please upload a valid Section image.',
                'section_image.mimes'  => 'Section image must be a file of type: jpg, jpeg, png, webp, svg.',
                'section_image.max'    => 'Section image size must not exceed 2MB.',
                'title.required'       => 'Title is required.',
                'title.max'            => 'Title must not exceed 255 characters.',
                'description.required' => 'Description is required.',
                'description.max'      => 'Description must not exceed 5000 characters.',
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
            $ibVisual = new IBVisual();
            $ibVisual->banner_heading   = $request->banner_heading;
            $ibVisual->banner_image     = $bannerName;
            $ibVisual->section_heading  = $request->section_heading;
            $ibVisual->section_image    = $sectionImageName;
            $ibVisual->title            = $request->title;
            $ibVisual->description      = $request->description;
            $ibVisual->inserted_by      = Auth::id();
            $ibVisual->inserted_at      = Carbon::now();
            $ibVisual->save();

            return redirect()->route('manage-ib-visual.index')
                            ->with('message', 'IB Visual record added successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; // Let Laravel handle validation errors

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $performing = IBVisual::findOrFail($id);
        return view('backend.campus.performing.edit', compact('performing'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the record
            $ibVisual = IBVisual::findOrFail($id);

            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'   => 'nullable|string|max:255',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'  => 'nullable|string|max:255',
                'section_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'title'            => 'required|string|max:255',
                'description'      => 'required|string|max:5000',
            ], [
                'banner_heading.max'   => 'Banner Heading must not exceed 255 characters.',
                'image.image'          => 'Please upload a valid Banner image.',
                'image.mimes'          => 'Banner image must be a file of type: jpg, jpeg, png, webp, svg.',
                'image.max'            => 'Banner image size must not exceed 2MB.',
                'section_heading.max'  => 'Section Heading must not exceed 255 characters.',
                'section_image.image'  => 'Please upload a valid Section image.',
                'section_image.mimes'  => 'Section image must be a file of type: jpg, jpeg, png, webp, svg.',
                'section_image.max'    => 'Section image size must not exceed 2MB.',
                'title.required'       => 'Title is required.',
                'title.max'            => 'Title must not exceed 255 characters.',
                'description.required' => 'Description is required.',
                'description.max'      => 'Description must not exceed 5000 characters.',
            ]);

            // ✅ Handle banner image upload (replace if new uploaded)
            if ($request->hasFile('banner_image')) {
                $banner = $request->file('banner_image');

                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();

                if (!file_exists(public_path('uploads/campus-life'))) {
                    mkdir(public_path('uploads/campus-life'), 0755, true);
                }

                $banner->move(public_path('uploads/campus-life'), $bannerName);

                if ($ibVisual->banner_image && file_exists(public_path('uploads/campus-life/' . $ibVisual->banner_image))) {
                    unlink(public_path('uploads/campus-life/' . $ibVisual->banner_image));
                }

                $ibVisual->banner_image = $bannerName;
            }


            // ✅ Handle section image upload (replace if new uploaded)
            if ($request->hasFile('section_image')) {
                // Delete old section image if exists
                if ($ibVisual->section_image && file_exists(public_path('uploads/campus-life/' . $ibVisual->section_image))) {
                    unlink(public_path('uploads/campus-life/' . $ibVisual->section_image));
                }
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(10, 999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/campus-life'), $sectionImageName);
                $ibVisual->section_image = $sectionImageName;
            }

            // ✅ Update other fields
            $ibVisual->banner_heading   = $request->banner_heading;
            $ibVisual->section_heading  = $request->section_heading;
            $ibVisual->title            = $request->title;
            $ibVisual->description      = $request->description;
            $ibVisual->modified_by       = Auth::id();
            $ibVisual->modified_at       = Carbon::now();
            $ibVisual->save();

            return redirect()->route('manage-ib-visual.index')
                            ->with('message', 'IB Visual record updated successfully.');

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
            $industries = IBVisual::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-ib-visual.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}