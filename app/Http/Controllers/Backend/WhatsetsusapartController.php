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
use App\Models\WhatSetsUsApart;

class WhatsetsusapartController extends Controller
{

    public function index()
    {
        $records = WhatSetsUsApart::wherenull('deleted_by')->get();
        return view('backend.about.set_apart.index', compact('records'));
    }

    public function create(Request $request)
    {
        return view('backend.about.set_apart.create');
    }

    public function store(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading' => 'required|string|max:255',
            'section_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading' => 'required|string|max:255',
            'section_description' => 'required|string',
        ], [
            'thumbnail.required' => 'Banner Image is required.',
            'banner_heading.required' => 'Banner Heading is required.',
            'section_heading.required' => 'Section Heading is required.',
            'section_description.required' => 'Section Description is required.',
        ]);

        // Handle Banner Image
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerImage);
        }

        // Handle Section Image
        $sectionImage = null;
        if ($request->hasFile('section_image')) {
            $image = $request->file('section_image');
            $sectionImage = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage);
        }

        // Store data
        $data = new WhatSetsUsApart();
        $data->banner_image = $bannerImage;
        $data->banner_heading = $request->banner_heading;
        $data->section_image = $sectionImage;
        $data->section_heading = $request->section_heading;
        $data->section_description = $request->section_description;
        $data->inserted_by = Auth::id();
        $data->inserted_at = Carbon::now();
        $data->save();

        return redirect()->route('manage-what-sets-us-apart.index')->with('message', 'Details successfully added.');
    }

    public function edit($id)
    {
        $set_apart = WhatSetsUsApart::findOrFail($id);
        return view('backend.about.set_apart.edit', compact('set_apart'));
    }

    public function update(Request $request, $id)
    {
        // Find the record
        $setApart = WhatSetsUsApart::findOrFail($id);

        // Validate request
        $validatedData = $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading' => 'required|string|max:255',
            'section_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading' => 'required|string|max:255',
            'section_description' => 'required|string',
        ], [
            'banner_heading.required' => 'Banner Heading is required.',
            'section_heading.required' => 'Section Heading is required.',
            'section_description.required' => 'Section Description is required.',
        ]);

        // Handle Banner Image
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerImage);

            // Delete old image if exists
            if ($setApart->banner_image && file_exists(public_path('uploads/about/' . $setApart->banner_image))) {
                unlink(public_path('uploads/about/' . $setApart->banner_image));
            }

            $setApart->banner_image = $bannerImage;
        }

        // Handle Section Image
        if ($request->hasFile('section_image')) {
            $image = $request->file('section_image');
            $sectionImage = time() . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage);

            // Delete old section image if exists
            if ($setApart->section_image && file_exists(public_path('uploads/about/' . $setApart->section_image))) {
                unlink(public_path('uploads/about/' . $setApart->section_image));
            }

            $setApart->section_image = $sectionImage;
        }

        // Update other fields
        $setApart->banner_heading = $request->banner_heading;
        $setApart->section_heading = $request->section_heading;
        $setApart->section_description = $request->section_description;
        $setApart->modified_by = Auth::id();
        $setApart->modified_at = Carbon::now();
        $setApart->save();

        return redirect()->route('manage-what-sets-us-apart.index')->with('message', 'Details successfully updated.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = WhatSetsUsApart::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-what-sets-us-apart.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}