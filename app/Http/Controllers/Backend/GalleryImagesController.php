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
use App\Models\GalleryImage;

class GalleryImagesController extends Controller
{

    public function index()
    {
        $galleryImages = GalleryImage::wherenull('deleted_by')->get();
        return view('backend.campus.gallery_images.index', compact('galleryImages'));
    }

    public function create(Request $request)
    {
        return view('backend.campus.gallery_images.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'   => 'nullable|string|max:255',
            'event_name'       => 'required|string|max:255',
            'thumbnail_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_image.*'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'event_name.required' => 'Please enter Event Name.',
            'gallery_image.*.required' => 'Please upload a Gallery Image.',
        ]);

        // ✅ Banner Image Upload
        $bannerName = null;
        if ($request->hasFile('thumbnail')) {
            $banner = $request->file('thumbnail');
            $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/campus-life'), $bannerName);
        }

        // ✅ Section Image Upload
        $sectionImageName = null;
        if ($request->hasFile('thumbnail_image')) {
            $sectionImage = $request->file('thumbnail_image');
            $sectionImageName = time() . '_' . rand(10, 999) . '.' . $sectionImage->getClientOriginalExtension();
            $sectionImage->move(public_path('uploads/campus-life'), $sectionImageName);
        }

        // ✅ Gallery Images Upload
        $galleryImages = [];
        if ($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $index => $image) {
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/campus-life/gallery'), $imageName);
                $galleryImages[] = $imageName;
            }
        }

        $slug = Str::slug($request->event_name, '-');

        // ✅ Store Data in DB
        $galleryData = json_encode($galleryImages);

        $gallery = new GalleryImage(); 
        $gallery->banner_image      = $bannerName;
        $gallery->banner_heading    = $request->banner_heading;
        $gallery->event_name        = $request->event_name;
        $gallery->slug              = $slug; 
        $gallery->thumbnail_image     = $sectionImageName;
        $gallery->gallery_images    = $galleryData; 
        $gallery->inserted_by      = Auth::id();
        $gallery->inserted_at      = Carbon::now();
        $gallery->save();

        return redirect()->route('manage-gallery-images.index')
                        ->with('message', 'Gallery images uploaded successfully!');
    }

    public function edit($id)
    {
        $gallery_images = GalleryImage::findOrFail($id);
        return view('backend.campus.gallery_images.edit', compact('gallery_images'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        try {
            // ✅ Find existing record
            $gallery = GalleryImage::findOrFail($id);

            // ✅ Validation
            $request->validate([
                'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'banner_heading'   => 'nullable|string|max:255',
                'event_name'       => 'required|string|max:255',
                'thumbnail_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'gallery_image.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ], [
                'event_name.required' => 'Please enter Event Name.',
                'gallery_image.*.image' => 'Each gallery image must be a valid image file.',
            ]);

            // ✅ Handle Banner Image Upload
            if ($request->hasFile('thumbnail')) {
                $banner = $request->file('thumbnail');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/campus-life'), $bannerName);

                // Delete old banner if exists
                if ($gallery->banner_image && file_exists(public_path('uploads/campus-life/' . $gallery->banner_image))) {
                    unlink(public_path('uploads/campus-life/' . $gallery->banner_image));
                }

                $gallery->banner_image = $bannerName;
            }

            // ✅ Handle Section / Thumbnail Image Upload
            if ($request->hasFile('thumbnail_image')) {
                $sectionImage = $request->file('thumbnail_image');
                $sectionImageName = time() . '_' . rand(10, 999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/campus-life'), $sectionImageName);

                // Delete old section image if exists
                if ($gallery->thumbnail_image && file_exists(public_path('uploads/campus-life/' . $gallery->thumbnail_image))) {
                    unlink(public_path('uploads/campus-life/' . $gallery->thumbnail_image));
                }

                $gallery->thumbnail_image = $sectionImageName;
            }

            // ✅ Handle Gallery Images Upload (append new images to existing JSON)
            $existingGalleryImages = $gallery->gallery_images ? json_decode($gallery->gallery_images, true) : [];
            if ($request->hasFile('gallery_image')) {
                foreach ($request->file('gallery_image') as $image) {
                    $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/campus-life/gallery'), $imageName);
                    $existingGalleryImages[] = $imageName;
                }
            }


            // ✅ Remove images that were deleted on the frontend
            $removedImages = $request->input('removed_gallery_images', []);
            if (!empty($removedImages)) {
                foreach ($removedImages as $filename) {
                    $path = public_path('uploads/campus-life/gallery/' . $filename);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    $existingGalleryImages = array_filter($existingGalleryImages, fn($img) => $img !== $filename);
                }
            }



            // ✅ Update other fields
            $gallery->banner_heading = $request->banner_heading;
            $gallery->event_name     = $request->event_name;
            $gallery->slug           = Str::slug($request->event_name, '-');
            $gallery->gallery_images = json_encode($existingGalleryImages);
            $gallery->modified_by     = Auth::id();
            $gallery->modified_at     = Carbon::now();

            $gallery->save();

            return redirect()->route('manage-gallery-images.index')
                            ->with('message', 'Gallery updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; 

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
            $industries = GalleryImage::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-gallery-images.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}