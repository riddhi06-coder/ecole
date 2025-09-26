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
use App\Models\VisionMission;

class VisionMissionController extends Controller
{

    public function index()
    {
        $visions = VisionMission::wherenull('deleted_by')->get(); 
        return view('backend.about.vision_mission.index', compact('visions'));
    }

    public function create(Request $request)
    {
        return view('backend.about.vision_mission.create');
    }

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'banner_heading'       => 'required|string|max:255',
            'banner'               => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_image'        => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'      => 'required|string|max:255',
            'section_image1'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'table_heading.*'      => 'required|string|max:255',
            'table_description.*'  => 'required|string',
            'icon.*'               => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'heading.*'            => 'required|string|max:255',
            'description_division.*' => 'required|string',
            'gallery_image.*'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'banner_heading.required' => 'Banner Heading is required.',
            'banner.required'         => 'Banner Image is required.',
            'section_image.required'  => 'Section 1 Image is required.',
            'section_heading.required'=> 'Section 2 Heading is required.',
            'section_image1.required' => 'Section 3 Image is required.',
            'table_heading.*.required'=> 'All Feature Table headings are required.',
            'table_description.*.required' => 'All Feature Table descriptions are required.',
            'icon.*.required'         => 'All Division icons are required.',
            'heading.*.required'      => 'All Division headings are required.',
            'description_division.*.required' => 'All Division descriptions are required.',
            'gallery_image.*.required'=> 'All Gallery Images are required.',
        ]);

        // Handle Banner Image
        $bannerImage = null;
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $bannerImage = time() . rand(10,999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerImage);
        }

        // Handle Section Images
        $sectionImage1 = null;
        $sectionImage2 = null;
        if ($request->hasFile('section_image')) {
            $image = $request->file('section_image');
            $sectionImage1 = time() . rand(1000,9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage1);
        }
        if ($request->hasFile('section_image1')) {
            $image = $request->file('section_image1');
            $sectionImage2 = time() . rand(1000,9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage2);
        }

        // Handle Division Details Table (icon, heading, description)
        $divisionDetails = [];
        if ($request->has('icon')) {
            foreach ($request->icon as $key => $iconFile) {
                $iconName = null;
                if ($iconFile) {
                    $iconName = time() . rand(1000,9999) . '.' . $iconFile->getClientOriginalExtension();
                    $iconFile->move(public_path('uploads/about'), $iconName);
                }
                $divisionDetails[] = [
                    'icon' => $iconName,
                    'heading' => $request->heading[$key] ?? '',
                    'description' => $request->description_division[$key] ?? '',
                ];
            }
        }

        // Handle Gallery Images
        $galleryData = [];
        if ($request->has('gallery_image')) {
            foreach ($request->gallery_image as $key => $galleryFile) {
                $galleryName = null;
                if ($galleryFile) {
                    $galleryName = time() . rand(1000,9999) . '.' . $galleryFile->getClientOriginalExtension();
                    $galleryFile->move(public_path('uploads/about'), $galleryName);
                }
                $galleryData[] = [
                    'image' => $galleryName,
                    'feature' => $request->gallery_features[$key] ?? '',
                ];
            }
        }

        // Handle Features Table
        $featuresData = [];
        if ($request->has('table_heading')) {
            foreach ($request->table_heading as $key => $heading) {
                $featuresData[] = [
                    'heading' => $heading,
                    'description' => $request->table_description[$key] ?? '',
                ];
            }
        }

        // Store in DB
        $visionMission = new VisionMission();
        $visionMission->banner_heading = $request->banner_heading;
        $visionMission->banner_image = $bannerImage;
        $visionMission->section_image = $sectionImage1;
        $visionMission->section_heading = $request->section_heading;
        $visionMission->section_image1 = $sectionImage2;
        $visionMission->division_details = json_encode($divisionDetails);
        $visionMission->gallery_images = json_encode($galleryData);
        $visionMission->features_table = json_encode($featuresData);
        $visionMission->inserted_by = Auth::id();
        $visionMission->inserted_at = Carbon::now();
        $visionMission->save();

        return redirect()->route('manage-vision-mission.index')->with('message', 'Vision & Mission details successfully added.');
    }

}