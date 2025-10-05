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
use App\Models\Career;

class CareerController extends Controller
{

    public function index()
    {
        $opportunities = Career::orderBy('id', 'asc')->wherenull('deleted_by')->get();
        return view('backend.careers.opportunities.index', compact('opportunities'));
    }

    public function create(Request $request)
    {
        return view('backend.careers.opportunities.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'thumbnail'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'  => 'required|string|max:255',
            'section_description' => 'required|string',
            'unit_titles.*'   => 'required|string|max:255',
            'unit_images.*'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'desc'            => 'required|string',
        ], [
            'thumbnail.required'      => 'Please upload a banner image.',
            'thumbnail.image'         => 'Banner must be a valid image.',
            'banner_heading.required' => 'Please enter a banner heading.',
            'section_description.required' => 'Please enter a section description.',
            'unit_titles.*.required'  => 'Please enter each unit title.',
            'unit_images.*.required'  => 'Please upload each unit image.',
            'unit_images.*.image'     => 'Each unit file must be a valid image.',
            'desc.required'           => 'Please enter a second description.',
        ]);

        // ✅ Store Banner Image
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/careers'), $bannerImage);
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

        // ✅ Save Data to Database
        $career = new Career(); // Replace with your model
        $career->banner_image       = $bannerImage;
        $career->banner_heading     = $request->banner_heading;
        $career->section_description = $request->section_description;
        $career->teaching_details      = json_encode($units);
        $career->desc               = $request->desc;
        $career->inserted_by        = Auth::id();
        $career->inserted_at        = Carbon::now();
        $career->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-career.index')->with('message', 'Career details added successfully!');
    }

    public function edit($id)
    {
        $opportunities = Career::findOrFail($id);
        return view('backend.careers.opportunities.edit', compact('opportunities'));
    }

    public function update(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        // ✅ Validation
        $request->validate([
            'thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'  => 'required|string|max:255',
            'section_description' => 'required|string',
            'unit_titles.*'   => 'required|string|max:255',
            'unit_images.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'desc'            => 'required|string',
        ], [
            'thumbnail.image'         => 'Banner must be a valid image.',
            'banner_heading.required' => 'Please enter a banner heading.',
            'section_description.required' => 'Please enter a section description.',
            'unit_titles.*.required'  => 'Please enter each unit title.',
            'unit_images.*.image'     => 'Each unit file must be a valid image.',
            'desc.required'           => 'Please enter a second description.',
        ]);

        // ✅ Update Banner Image if uploaded
        if ($request->hasFile('thumbnail')) {
            // Delete old banner image if exists
            if ($career->banner_image && file_exists(public_path('uploads/careers/' . $career->banner_image))) {
                unlink(public_path('uploads/careers/' . $career->banner_image));
            }

            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/careers'), $bannerImage);
            $career->banner_image = $bannerImage;
        }

        // ✅ Update Units Offered
        $units = [];
        if ($request->has('unit_titles')) {
            $existingUnits = json_decode($career->teaching_details, true) ?? [];

            foreach ($request->unit_titles as $index => $title) {
                $unitImageName = $existingUnits[$index]['image'] ?? null;

                // If new image uploaded for this unit
                if (isset($request->unit_images[$index]) && $request->unit_images[$index]) {
                    $unitImage = $request->unit_images[$index];

                    // Delete old image if exists
                    if ($unitImageName && file_exists(public_path('uploads/careers/' . $unitImageName))) {
                        unlink(public_path('uploads/careers/' . $unitImageName));
                    }

                    $unitImageName = time() . rand(10000, 99999) . '.' . $unitImage->getClientOriginalExtension();
                    $unitImage->move(public_path('uploads/careers'), $unitImageName);
                }

                $units[] = [
                    'title' => $title,
                    'image' => $unitImageName,
                ];
            }
        }

        // ✅ Update other fields
        $career->banner_heading       = $request->banner_heading;
        $career->section_description  = $request->section_description;
        $career->teaching_details     = json_encode($units);
        $career->desc                 = $request->desc;
        $career->modified_by           = Auth::id();
        $career->modified_at           = Carbon::now();
        $career->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-career.index')->with('message', 'Career details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Career::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-career.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}