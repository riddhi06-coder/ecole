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
use App\Models\CreativityActivity;

class CreativityController extends Controller
{
    
    public function index()
    {
        $activities = CreativityActivity::whereNull('deleted_at')->get();
        return view('backend.academics.curriculum.creativity.index', compact('activities'));
    }

    public function create(Request $request)
    {
        return view('backend.academics.curriculum.creativity.create');
    }

    public function store(Request $request)
    {
        // dd($request); 
        if ($request->detailed_page === 'yes' && isset($request->event_name)) {
            $filledEventName = [];
            $filledDescriptions = [];
            $filledBannerImages = [];
            $filledGalleryImages = [];

            foreach ($request->event_name as $i => $eventName) {
                $description = $request->detailed_description[$i] ?? null;
                $banner = $request->banner_image[$i] ?? null;
                $gallery = $request->gallery_images[$i] ?? null;

                // Only include sections where at least one required field is filled
                if (!empty($eventName) || !empty($description) || !empty($banner)) {
                    $filledEventName[] = $eventName;
                    $filledDescriptions[] = $description;
                    $filledBannerImages[] = $banner;
                    $filledGalleryImages[] = $gallery ?? [];
                }
            }

            // Overwrite request arrays so validation ignores empty sections
            $request->merge([
                'event_name' => $filledEventName,
                'detailed_description' => $filledDescriptions,
                'banner_image' => $filledBannerImages,
                'gallery_images' => $filledGalleryImages,
            ]);
        }


        // ✅ Validation
        $validated = $request->validate([
            'banner_heading'    => 'nullable|string|max:255',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'section_heading'   => 'nullable|string|max:255',
            'section_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'section_description' => 'nullable|string',
            'title'             => 'required|string|max:255',
            'detailed_page'     => 'required|in:yes,no',
            'description'       => 'required_if:detailed_page,no|string',

            // Detailed sections: only validate if detailed_page = yes
            'event_name.*'           => $request->detailed_page === 'yes' ? 'required|string|max:255' : 'nullable|string',
            'banner_image.*'         => $request->detailed_page === 'yes' ? 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048' : 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'detailed_description.*' => $request->detailed_page === 'yes' ? 'required|string' : 'nullable|string',
            'gallery_images'         => 'nullable|array',
            'gallery_images.*.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ], [
            'title.required' => 'Title is required.',
            'detailed_page.required' => 'Please select whether this is a detailed page.',
            'description.required_if' => 'Description is required if detailed page is No.',

            'event_name.*.required' => 'Event Name is required for each detailed section.',
            'banner_image.*.required' => 'Detailed Page Banner Image is required for each section.',
            'detailed_description.*.required' => 'Detailed Description is required for each section.',
        ]);


        // ✅ Upload main banner
        $bannerImage = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $bannerImage);
        }

        // ✅ Upload section image
        $sectionImage = null;
        if ($request->hasFile('section_image')) {
            $img = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/academics'), $sectionImage);
        }

        // ✅ Prepare detailed sections
        $detailedSections = [];
        if ($request->detailed_page === 'yes' && isset($request->event_name)) {
            foreach ($request->event_name as $index => $eventName) {

                // Banner image for this section
                $banner = null;
                if (isset($request->banner_image[$index]) && $request->banner_image[$index]->isValid()) {
                    $file = $request->banner_image[$index];
                    $banner = time() . rand(10, 999) . '.' . $file->getClientOriginalExtension();

                    try {
                        $file->move(public_path('uploads/academics'), $banner);
                    } catch (\Exception $e) {
                        dd('Banner upload failed:', $e->getMessage(), $file->getError());
                    }
                }


                // Gallery images for this section
                $galleries = [];
                if (isset($request->gallery_images[$index])) {
                    foreach ($request->gallery_images[$index] as $galleryFile) {
                        if ($galleryFile && $galleryFile->isValid()) { // ✅ Only process valid files
                            $galleryName = time() . rand(10, 999) . '.' . $galleryFile->getClientOriginalExtension();
                            $galleryFile->move(public_path('uploads/academics'), $galleryName);
                            $galleries[] = $galleryName;
                        }
                    }
                }

                $detailedSections[] = [
                    'event_name'           => $eventName,
                    'slug'                 => Str::slug($eventName),
                    'banner_image'         => $banner,
                    'detailed_description' => $request->detailed_description[$index] ?? null,
                    'gallery_images'       => $galleries,
                ];
            }
        }

        // ✅ Store in DB
        $activity = new CreativityActivity();
        $activity->banner_heading    = $validated['banner_heading'] ?? null;
        $activity->banner_image      = $bannerImage;
        $activity->section_heading   = $validated['section_heading'] ?? null;
        $activity->section_image     = $sectionImage;
        $activity->section_description  = $validated['section_description'] ?? null;
        $activity->title             = $validated['title'];
        $activity->detailed_page     = $validated['detailed_page'];
        $activity->description       = $validated['description'] ?? null;
        $activity->detailed_sections = json_encode($detailedSections) ?? null ; // store sections as JSON
        $activity->inserted_by        = Auth::id();
        $activity->inserted_at        = Carbon::now();
        $activity->save();

        return redirect()->route('manage-creativity-activity.index')
                        ->with('message', 'Creativity Activity has been added successfully.');
    }

    public function edit($id)
    {
        $creativity = CreativityActivity::findOrFail($id);
        return view('backend.academics.curriculum.creativity.edit', compact('creativity'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);    
        $activity = CreativityActivity::findOrFail($id);

        $validated = $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'section_heading' => 'nullable|string|max:255',
            'section_image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'section_description' => 'nullable|string',
            'title' => 'required|string|max:255',
            'detailed_page' => 'required|in:yes,no',
            'description' => 'required_if:detailed_page,no|string',
            'event_name.*' => 'nullable|string|max:255',
            'banner_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'detailed_description.*' => 'nullable|string',
            'gallery_images' => 'nullable|array',
            'gallery_images.*.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'old_gallery_images' => 'nullable|array',
            'removed_gallery_images' => 'nullable|array',
        ]);

        Log::info('Validated CAS Data:', $validated);

        // Handle main banner image
        $bannerImage = $activity->banner_image;
        if ($request->hasFile('image')) {
            if ($bannerImage && file_exists(public_path('uploads/academics/' . $bannerImage))) {
                @unlink(public_path('uploads/academics/' . $bannerImage));
            }
            $file = $request->file('image');
            $bannerImage = time() . rand(10, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/academics'), $bannerImage);
        }

        // Handle section image
        $sectionImage = $activity->section_image;
        if ($request->hasFile('section_image')) {
            if ($sectionImage && file_exists(public_path('uploads/academics/' . $sectionImage))) {
                @unlink(public_path('uploads/academics/' . $sectionImage));
            }
            $file = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/academics'), $sectionImage);
        }

        // Get old sections and filter out fully empty ones
        // Decode old sections and remove fully empty ones
        $oldSections = json_decode($activity->detailed_sections, true) ?? [];
        $oldSections = array_filter($oldSections, function($section) {
            return !empty($section['event_name']) 
                || !empty($section['detailed_description']) 
                || !empty($section['banner_image']) 
                || (!empty($section['gallery_images']) && count($section['gallery_images']) > 0);
        });

        // Start fresh array
        $detailedSections = [];

        // Only process detailed page sections
        if ($request->detailed_page === 'yes' && $request->event_name) {
            $eventNames = $request->event_name;
            $detailedDescriptions = $request->detailed_description ?? [];
            $bannerImages = $request->banner_image ?? [];
            $galleryImages = $request->gallery_images ?? [];
            $oldGalleryImages = $request->old_gallery_images ?? [];
            $removedGalleryImages = $request->removed_gallery_images ?? [];

            foreach ($eventNames as $index => $eventName) {
                $description = $detailedDescriptions[$index] ?? null;
                $oldGalleries = $oldGalleryImages[$index] ?? [];
                $removedGalleries = $removedGalleryImages[$index] ?? [];
                $newGalleryFiles = $galleryImages[$index] ?? [];

                // Skip section if completely empty
                $hasOldGallery = !empty($oldGalleries) && count(array_filter($oldGalleries)) > 0;
                if (empty($eventName) && empty($description) && !$hasOldGallery) {
                    continue;
                }

                // Section banner
                $bannerFile = $bannerImages[$index] ?? null;
                $banner = $oldSections[$index]['banner_image'] ?? null;
                if ($bannerFile instanceof \Illuminate\Http\UploadedFile) {
                    $banner = time() . '_' . rand(10, 999) . '.' . $bannerFile->getClientOriginalExtension();
                    $bannerFile->move(public_path('uploads/academics'), $banner);
                }

                // Prepare galleries
                $galleries = [];

                // Keep old galleries except removed
                foreach ($oldGalleries as $oldImg) {
                    if ($oldImg && (!is_array($removedGalleries) || !in_array($oldImg, $removedGalleries))) {
                        $galleries[] = $oldImg;
                    }
                }

                // Flatten and upload new gallery files
                $flatGalleryFiles = [];
                foreach ($newGalleryFiles as $files) {
                    if (is_array($files)) $flatGalleryFiles = array_merge($flatGalleryFiles, $files);
                    elseif ($files) $flatGalleryFiles[] = $files;
                }
                foreach ($flatGalleryFiles as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        $galleryName = time() . '_' . rand(10, 999) . '_' . 
                            preg_replace('/[^a-zA-Z0-9_\-]/','_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . 
                            '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/academics'), $galleryName);
                        $galleries[] = $galleryName;
                    }
                }

                // Add this section only if it has some data
                $detailedSections[] = [
                    'event_name' => $eventName ?: null,
                    'slug' => $eventName ? Str::slug($eventName) : '',
                    'banner_image' => $banner,
                    'detailed_description' => $description,
                    'gallery_images' => $galleries,
                ];
            }
        }

        // Reindex to remove gaps
        $detailedSections = array_values($detailedSections);





        // Update activity
        $activity->update([
            'banner_heading'      => $validated['banner_heading'] ?? $activity->banner_heading,
            'banner_image'        => $bannerImage,
            'section_heading'     => $validated['section_heading'] ?? $activity->section_heading,
            'section_image'       => $sectionImage,
            'section_description' => $validated['section_description'] ?? $activity->section_description,
            'title'               => $validated['title'],
            'detailed_page'       => $validated['detailed_page'],
            'description'         => $request->input('description'),

            'detailed_sections'   => json_encode($detailedSections),
            'modified_by'         => Auth::id(),
            'modified_at'         => now(),
        ]);

        return redirect()->route('manage-creativity-activity.index')
            ->with('message', 'Creativity Activity has been updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = CreativityActivity::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-creativity-activity.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}