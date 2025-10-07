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
use App\Models\CreativityActivity;

class CreativityController extends Controller
{
    
    public function index()
    {
        return view('backend.academics.curriculum.creativity.index');
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
            'title'             => 'required|string|max:255',
            'detailed_page'     => 'required|in:yes,no',
            'description'       => 'required_if:detailed_page,no|string',

            // Detailed sections
           'event_name.*'           => 'required_if:detailed_page,yes|string|max:255',
            'banner_image.*'         => 'required_if:detailed_page,yes|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'detailed_description.*' => 'required_if:detailed_page,yes|string',
            'gallery_images'         => 'nullable|array',
            'gallery_images.*.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',

        ], [
            'title.required'                     => 'Title is required.',
            'detailed_page.required'             => 'Please select whether this is a detailed page.',
            'description.required_if'            => 'Description is required if detailed page is No.',

            'event_name.*.required_if'           => 'Event Name is required for each detailed section.',
            'banner_image.*.required_if'         => 'Detailed Page Banner Image is required for each section.',
            'banner_image.*.image'               => 'Banner Image must be a valid image.',
            'banner_image.*.mimes'               => 'Allowed formats for Banner Image: jpg, jpeg, png, webp, svg.',
            'banner_image.*.max'                 => 'Maximum size for Banner Image is 2MB.',

            'detailed_description.*.required_if' => 'Detailed Description is required for each section.',

            'gallery_images.required_if'         => 'At least one gallery image is required for each section.',
            'gallery_images.*.*.required_if'     => 'Gallery image is required.',
            'gallery_images.*.*.image'           => 'Gallery images must be valid images.',
            'gallery_images.*.*.mimes'           => 'Allowed formats for Gallery Images: jpg, jpeg, png, webp, svg.',
            'gallery_images.*.*.max'             => 'Maximum size for each Gallery Image is 2MB.',
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
        $activity->title             = $validated['title'];
        $activity->detailed_page     = $validated['detailed_page'];
        $activity->description       = $validated['description'] ?? null;
        $activity->detailed_sections = json_encode($detailedSections); // store sections as JSON
        $activity->inserted_by        = Auth::id();
        $activity->inserted_at        = Carbon::now();
        $activity->save();

        return redirect()->route('manage-creativity-activity.index')
                        ->with('message', 'Creativity Activity has been added successfully.');
    }




}