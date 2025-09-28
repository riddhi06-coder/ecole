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
use App\Models\AccredationAssociation;

class AccredationController extends Controller
{

    public function index()
    {
        $associations = AccredationAssociation::wherenull('deleted_by')->get(); 
        return view('backend.about.accredation.index', compact('associations'));
    }

    public function create(Request $request)
    {
        return view('backend.about.accredation.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'banner'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'=> 'nullable|string|max:255',
            'section_desc'   => 'nullable|string',

            'org_name'       => 'required|string|max:255',
            'org_image'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'org_desc'       => 'required|string',

            'gallery_image.*'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'banner.image'   => 'The banner image must be an image file.',
            'banner.mimes'   => 'The banner must be a file of type: jpg, jpeg, png, webp.',
            'banner.max'     => 'The banner must not exceed 2MB.',

            'org_name.required'  => 'Please enter Organization Name.',
            'org_image.required' => 'Please upload Organization Image.',
            'org_desc.required'  => 'Please enter Organization Description.',

            'gallery_image.*.image' => 'Each gallery file must be an image.',
            'gallery_image.*.mimes' => 'Gallery images must be jpg, jpeg, png, or webp.',
            'gallery_image.*.max'   => 'Each gallery image must not exceed 2MB.',
        ]);

        // ✅ Handle Banner Upload
        $bannerFile = null;
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerFile = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/about'), $bannerFile);
        }

        // ✅ Handle Organization Image Upload
        $orgFile = null;
        if ($request->hasFile('org_image')) {
            $file = $request->file('org_image');
            $orgFile = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/about'), $orgFile);
        }

        // ✅ Handle Gallery Images (store as JSON)
        $galleryFiles = [];
        if ($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $file) {
                if ($file) {
                    $fileName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/about'), $fileName);
                    $galleryFiles[] = $fileName;
                }
            }
        }

        // ✅ Save Data
        $assoc = new AccredationAssociation();
        $assoc->banner_heading   = $validated['banner_heading'] ?? null;
        $assoc->banner_image     = $bannerFile;
        $assoc->section_heading  = $validated['section_heading'] ?? null;
        $assoc->section_desc     = $validated['section_desc'];
        $assoc->org_name         = $validated['org_name'];
        $assoc->org_image        = $orgFile;
        $assoc->org_desc         = $validated['org_desc'];
        $assoc->gallery_images   = json_encode($galleryFiles); 
        $assoc->inserted_by      = Auth::id();
        $assoc->inserted_at      = now();
        $assoc->save();

        return redirect()->route('manage-accredation-association.index')->with('message', 'Accreditation & Association details added successfully!');
    }

    public function edit($id)
    {
        $accredation = AccredationAssociation::findOrFail($id);
        return view('backend.about.accredation.edit', compact('accredation'));
    }

    public function update(Request $request, $id)
    {
        $assoc = AccredationAssociation::findOrFail($id);

        // ✅ Validation
        $validated = $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'banner'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'=> 'nullable|string|max:255',
            'section_desc'   => 'nullable|string',

            'org_name'       => 'required|string|max:255',
            'org_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'org_desc'       => 'required|string',

            'gallery_image.*'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'banner.image'   => 'The banner image must be an image file.',
            'banner.mimes'   => 'The banner must be a file of type: jpg, jpeg, png, webp.',
            'banner.max'     => 'The banner must not exceed 2MB.',

            'org_name.required'  => 'Please enter Organization Name.',
            'org_image.image'    => 'The organization image must be an image file.',
            'org_image.mimes'    => 'Organization image must be jpg, jpeg, png, or webp.',
            'org_image.max'      => 'Organization image must not exceed 2MB.',
            'org_desc.required'  => 'Please enter Organization Description.',

            'gallery_image.*.image' => 'Each gallery file must be an image.',
            'gallery_image.*.mimes' => 'Gallery images must be jpg, jpeg, png, or webp.',
            'gallery_image.*.max'   => 'Each gallery image must not exceed 2MB.',
        ]);

        // ✅ Handle Banner Upload
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerFile = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/about'), $bannerFile);
            $assoc->banner_image = $bannerFile;
        }

        // ✅ Handle Organization Image Upload
        if ($request->hasFile('org_image')) {
            $file = $request->file('org_image');
            $orgFile = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/about'), $orgFile);
            $assoc->org_image = $orgFile;
        }

        // Get existing images sent from the form
        $existingGallery = $request->input('existing_gallery', []);

        // Process new uploaded images
        $newGallery = [];
        if ($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $file) {
                if ($file) {
                    $fileName = time() . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/about'), $fileName);
                    $newGallery[] = $fileName;
                }
            }
        }

        // Merge and store only images that exist in form
        $assoc->gallery_images = json_encode(array_merge($existingGallery, $newGallery));


        // ✅ Update other fields
        $assoc->banner_heading  = $validated['banner_heading'] ?? $assoc->banner_heading;
        $assoc->section_heading = $validated['section_heading'] ?? $assoc->section_heading;
        $assoc->section_desc    = $validated['section_desc'];
        $assoc->org_name        = $validated['org_name'];
        $assoc->org_desc        = $validated['org_desc'];
        $assoc->modified_by     = Auth::id();
        $assoc->modified_at     = Carbon::now();

        $assoc->save();

        return redirect()->route('manage-accredation-association.index')->with('message', 'Accreditation & Association details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = AccredationAssociation::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-accredation-association.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}
