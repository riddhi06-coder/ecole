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
use App\Models\MediaCenter;

class MediaCenterController extends Controller
{

    public function index()
    {
        $mediaCenters = MediaCenter::orderBy('id', 'asc')->wherenull('deleted_by')->get();
        return view('backend.campus.media.index', compact('mediaCenters'));
    }

    public function create(Request $request)
    {
        return view('backend.campus.media.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'   => 'nullable|string|max:255',
                'url'              => 'nullable|url|max:255',
                'banner_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'  => 'nullable|string|max:255',
                'section_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'title'            => 'required|string|max:255',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'description'      => 'nullable|string|max:5000',
            ], [
                'banner_heading.max'    => 'Banner Heading must not exceed 255 characters.',
                'banner_image.image'    => 'Please upload a valid banner image.',
                'banner_image.mimes'    => 'Banner image must be a file of type: jpg, jpeg, png, webp, svg.',
                'banner_image.max'      => 'Banner image size must not exceed 2MB.',
                'section_heading.max'   => 'Section Heading must not exceed 255 characters.',
                'section_image.image'   => 'Please upload a valid section image.',
                'section_image.mimes'   => 'Section image must be a file of type: jpg, jpeg, png, webp, svg.',
                'section_image.max'     => 'Section image size must not exceed 2MB.',
                'title.required'        => 'Title is required.',
                'title.max'             => 'Title must not exceed 255 characters.',
                'image.image'           => 'Please upload a valid image.',
                'image.mimes'           => 'Image must be a file of type: jpg, jpeg, png, webp, svg.',
                'image.max'             => 'Image size must not exceed 2MB.',
                'description.max'       => 'Description must not exceed 5000 characters.',
            ]);

            // ✅ Handle banner image upload
            $bannerName = null;
            if ($request->hasFile('banner_image')) {
                $banner = $request->file('banner_image');
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

            // ✅ Handle additional image upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/campus-life'), $imageName);
            }

            // ✅ Save to database
            $media = new MediaCenter(); // Make sure your model is MediaCenter
            $media->banner_heading   = $request->banner_heading;
            $media->banner_image     = $bannerName;
            $media->section_heading  = $request->section_heading;
            $media->section_image    = $sectionImageName;
            $media->title            = $request->title;
            $media->url            = $request->url;
            $media->image            = $imageName;
            $media->description      = $request->description;
            $media->inserted_by      = Auth::id();
            $media->inserted_at      = Carbon::now();
            $media->save();

            return redirect()->route('manage-media-center.index')
                            ->with('message', 'Media Center record added successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; // Let Laravel handle validation errors

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $media = MediaCenter::findOrFail($id);
        $firstRecord = MediaCenter::first();

        return view('backend.campus.media.edit', compact('media', 'firstRecord'));
    }

    public function update(Request $request, $id)
    {
        try {
            // ✅ Find record
            $media = MediaCenter::findOrFail($id);

            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'   => 'nullable|string|max:255',
                'url'              => 'nullable|url|max:255',
                'banner_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'  => 'nullable|string|max:255',
                'section_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'title'            => 'required|string|max:255',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'description'      => 'nullable|string|max:5000',
            ], [
                'banner_heading.max'    => 'Banner Heading must not exceed 255 characters.',
                'banner_image.image'    => 'Please upload a valid banner image.',
                'banner_image.mimes'    => 'Banner image must be a file of type: jpg, jpeg, png, webp, svg.',
                'banner_image.max'      => 'Banner image size must not exceed 2MB.',
                'section_heading.max'   => 'Section Heading must not exceed 255 characters.',
                'section_image.image'   => 'Please upload a valid section image.',
                'section_image.mimes'   => 'Section image must be a file of type: jpg, jpeg, png, webp, svg.',
                'section_image.max'     => 'Section image size must not exceed 2MB.',
                'title.required'        => 'Title is required.',
                'title.max'             => 'Title must not exceed 255 characters.',
                'image.image'           => 'Please upload a valid image.',
                'image.mimes'           => 'Image must be a file of type: jpg, jpeg, png, webp, svg.',
                'image.max'             => 'Image size must not exceed 2MB.',
                'description.max'       => 'Description must not exceed 5000 characters.',
            ]);

            // ✅ Handle banner image upload
            if ($request->hasFile('banner_image')) {
                $banner = $request->file('banner_image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/campus-life'), $bannerName);

                // Delete old banner
                if ($media->banner_image && file_exists(public_path('uploads/campus-life/'.$media->banner_image))) {
                    unlink(public_path('uploads/campus-life/'.$media->banner_image));
                }

                $media->banner_image = $bannerName;
            }

            // ✅ Handle section image upload
            if ($request->hasFile('section_image')) {
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(10, 999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/campus-life'), $sectionImageName);

                // Delete old section image
                if ($media->section_image && file_exists(public_path('uploads/campus-life/'.$media->section_image))) {
                    unlink(public_path('uploads/campus-life/'.$media->section_image));
                }

                $media->section_image = $sectionImageName;
            }

            // ✅ Handle additional image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/campus-life'), $imageName);

                // Delete old image
                if ($media->image && file_exists(public_path('uploads/campus-life/'.$media->image))) {
                    unlink(public_path('uploads/campus-life/'.$media->image));
                }

                $media->image = $imageName;
            }

            // ✅ Update other fields
            // Only update banner/section fields if this is NOT the first record
            if ($media->id != 1) {
                $media->banner_heading  = $request->banner_heading;
                $media->section_heading = $request->section_heading;
            }

            $media->title       = $request->title;
            $media->url         = $request->url;
            $media->description = $request->description;
            $media->modified_by = Auth::id();
            $media->modified_at = Carbon::now();
            $media->save();

            return redirect()->route('manage-media-center.index')
                            ->with('message', 'Media Center record updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; // Laravel will handle validation errors

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
            $industries = MediaCenter::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-media-center.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}