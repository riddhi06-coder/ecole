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
use App\Models\UniversityBath;

class UniversityController extends Controller
{

    public function index()
    {
        $university = UniversityBath::wherenull('deleted_by')->get();
        return view('backend.careers.university.index', compact('university'));
    }

    public function create(Request $request)
    {
        return view('backend.careers.university.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'thumbnail'           => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'      => 'required|string|max:255',
            'section_heading'     => 'required|string|max:255',
            'videos_url'          => 'required|string|max:255',
            'section_description' => 'required|string',
            'unit_heading'        => 'required|string|max:255',
            'bkg_image'           => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'unit_titles.*'       => 'required|string|max:255',
            'unit_images.*'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'desc'                => 'required|string',
            'doc_names.*'         => 'required|string|max:255',
            'doc_files.*'         => 'required|mimes:pdf,doc,docx|max:2048',
        ], [
            'thumbnail.required'       => 'Please upload a banner image.',
            'thumbnail.image'          => 'Banner must be a valid image.',
            'banner_heading.required'  => 'Please enter a banner heading.',
            'section_heading.required' => 'Please enter a section heading.',
            'videos_url.required'      => 'Please enter a video URL.',
            'section_description.required' => 'Please enter a section description.',
            'unit_heading.required'    => 'Please enter the unit heading.',
            'bkg_image.required'       => 'Please upload the background image.',
            'unit_titles.*.required'   => 'Please enter each unit title.',
            'unit_images.*.required'   => 'Please upload each unit image.',
            'desc.required'            => 'Please enter a description.',
            'doc_names.*.required'     => 'Please enter each document name.',
            'doc_files.*.required'     => 'Please upload each document file.',
        ]);

        // ✅ Store Banner Image
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/careers'), $bannerImage);
        }

        // ✅ Store Background Image
        $backgroundImage = null;
        if ($request->hasFile('bkg_image')) {
            $bkg = $request->file('bkg_image');
            $backgroundImage = time() . rand(1000, 9999) . '.' . $bkg->getClientOriginalExtension();
            $bkg->move(public_path('uploads/careers'), $backgroundImage);
        }

        // ✅ Store Units Offered (Multiple rows)
        $units = [];
        if ($request->has('unit_titles')) {
            foreach ($request->unit_titles as $index => $title) {
                $unitImageName = null;
                if (isset($request->unit_images[$index])) {
                    $unitImage = $request->unit_images[$index];
                    $unitImageName = time() . rand(10000, 99999) . '.' . $unitImage->getClientOriginalExtension();
                    $unitImage->move(public_path('uploads/careers'), $unitImageName);
                }
                $units[] = [
                    'title' => $title,
                    'image' => $unitImageName,
                ];
            }
        }

        // ✅ Store Documents (Multiple rows)
        $documents = [];
        if ($request->has('doc_names')) {
            foreach ($request->doc_names as $index => $docName) {
                $docFileName = null;
                if (isset($request->doc_files[$index])) {
                    $docFile = $request->doc_files[$index];
                    $docFileName = time() . rand(100000, 999999) . '.' . $docFile->getClientOriginalExtension();
                    $docFile->move(public_path('uploads/careers'), $docFileName);
                }
                $documents[] = [
                    'name' => $docName,
                    'file' => $docFileName,
                ];
            }
        }

        // ✅ Save to Database
        $university = new UniversityBath();
        $university->banner_image = $bannerImage;
        $university->banner_heading = $request->banner_heading;
        $university->section_heading = $request->section_heading;
        $university->videos_url = $request->videos_url;
        $university->section_description = $request->section_description;
        $university->unit_heading = $request->unit_heading;
        $university->bkg_image = $backgroundImage;
        $university->units_offered = json_encode($units);
        $university->desc = $request->desc;
        $university->documents = json_encode($documents);
        $university->inserted_by = Auth::id();
        $university->inserted_at = Carbon::now();
        $university->save();

        // ✅ Redirect with Success Message
        return redirect()->route('manage-university-bath.index')->with('message', 'University Bath details added successfully!');
    }

    public function edit($id)
    {
        $university = UniversityBath::findOrFail($id);
        return view('backend.careers.university.edit', compact('university'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Find the record
        $university = UniversityBath::findOrFail($id);

        // ✅ Validation
        $request->validate([
            'thumbnail'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'      => 'required|string|max:255',
            'section_heading'     => 'required|string|max:255',
            'videos_url'          => 'required|string|max:255',
            'section_description' => 'required|string',
            'unit_heading'        => 'required|string|max:255',
            'bkg_image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'unit_titles.*'       => 'required|string|max:255',
            'unit_images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'desc'                => 'required|string',
            'doc_names.*'         => 'required|string|max:255',
            'doc_files.*'         => 'nullable|mimes:pdf,doc,docx|max:2048',
        ], [
            'banner_heading.required'  => 'Please enter a banner heading.',
            'section_heading.required' => 'Please enter a section heading.',
            'videos_url.required'      => 'Please enter a video URL.',
            'section_description.required' => 'Please enter a section description.',
            'unit_heading.required'    => 'Please enter the unit heading.',
            'unit_titles.*.required'   => 'Please enter each unit title.',
            'desc.required'            => 'Please enter a description.',
            'doc_names.*.required'     => 'Please enter each document name.',
        ]);

        // ✅ Update Banner Image if new uploaded
        if ($request->hasFile('thumbnail')) {
            // Delete old banner if exists
            if ($university->banner_image && file_exists(public_path('uploads/careers/'.$university->banner_image))) {
                unlink(public_path('uploads/careers/'.$university->banner_image));
            }

            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/careers'), $bannerImage);
            $university->banner_image = $bannerImage;
        }

        // ✅ Update Background Image if new uploaded
        if ($request->hasFile('bkg_image')) {
            if ($university->bkg_image && file_exists(public_path('uploads/careers/'.$university->bkg_image))) {
                unlink(public_path('uploads/careers/'.$university->bkg_image));
            }

            $bkg = $request->file('bkg_image');
            $backgroundImage = time() . rand(1000, 9999) . '.' . $bkg->getClientOriginalExtension();
            $bkg->move(public_path('uploads/careers'), $backgroundImage);
            $university->bkg_image = $backgroundImage;
        }

        // ✅ Update Units Offered
        // ✅ Update Units Offered
        $units = [];
        if ($request->has('unit_titles')) {
            $existingUnitImages = $request->existing_unit_image ?? []; // hidden inputs

            foreach ($request->unit_titles as $index => $title) {
                $unitImageName = $existingUnitImages[$index] ?? null;

                // If new image uploaded, replace it
                if (isset($request->unit_images[$index]) && $request->unit_images[$index]) {
                    $unitImage = $request->unit_images[$index];

                    // Delete old image if exists
                    if ($unitImageName && file_exists(public_path('uploads/careers/' . $unitImageName))) {
                        unlink(public_path('uploads/careers/' . $unitImageName));
                    }

                    $unitImageName = time() . rand(10000, 99999) . '.' . $unitImage->getClientOriginalExtension();
                    $unitImage->move(public_path('uploads/careers'), $unitImageName);
                }

                // Only add to array if title or image exists (prevents empty rows)
                if ($title || $unitImageName) {
                    $units[] = [
                        'title' => $title,
                        'image' => $unitImageName,
                    ];
                }
            }
        }


        // ✅ Update Documents
        $documents = [];
        if ($request->has('doc_names')) {
            $existingFiles = $request->existing_doc_file ?? []; // hidden inputs

            foreach ($request->doc_names as $index => $docName) {
                $docFileName = $existingFiles[$index] ?? null;

                // If new file uploaded, replace it
                if (isset($request->doc_files[$index]) && $request->doc_files[$index]) {
                    $docFile = $request->doc_files[$index];

                    // Delete old file if exists
                    if ($docFileName && file_exists(public_path('uploads/careers/' . $docFileName))) {
                        unlink(public_path('uploads/careers/' . $docFileName));
                    }

                    $docFileName = time() . rand(100000, 999999) . '.' . $docFile->getClientOriginalExtension();
                    $docFile->move(public_path('uploads/careers'), $docFileName);
                }

                // Only add to array if name or file exists (prevents empty rows)
                if ($docName || $docFileName) {
                    $documents[] = [
                        'name' => $docName,
                        'file' => $docFileName,
                    ];
                }
            }
        }

        // ✅ Update Other Fields
        $university->banner_heading = $request->banner_heading;
        $university->section_heading = $request->section_heading;
        $university->videos_url = $request->videos_url;
        $university->section_description = $request->section_description;
        $university->unit_heading = $request->unit_heading;
        $university->units_offered = json_encode($units);
        $university->desc = $request->desc;
        $university->documents = json_encode($documents);
        $university->modified_by = Auth::id();
        $university->modified_at = Carbon::now();
        $university->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-university-bath.index')->with('message', 'University Bath details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = UniversityBath::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-university-bath.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}