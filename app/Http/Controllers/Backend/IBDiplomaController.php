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
use App\Models\IBDiploma;

class IBDiplomaController extends Controller
{
    
    public function index()
    {
        $curriculum = IBDiploma::wherenull('deleted_by')->get();
        return view('backend.academics.curriculum.diploma.index', compact('curriculum'));
    }

    public function create(Request $request)
    {
        return view('backend.academics.curriculum.diploma.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([
            'banner_heading'   => 'required|string|max:255',
            'image'            => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ], [
            'banner_heading.required' => 'Banner Heading is required.',
            'banner_heading.string'   => 'Banner Heading must be a valid string.',
            'banner_heading.max'      => 'Banner Heading cannot exceed 255 characters.',

            'image.required'          => 'Please upload a Banner Image.',
            'image.image'             => 'The file must be an image.',
            'image.mimes'             => 'Only jpg, jpeg, png, webp, svg files are allowed.',
            'image.max'               => 'Maximum file size allowed is 2MB.',
        ]);

        // ✅ Handle Banner Image Upload (manual)
        $bannerImage = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $bannerImage);
        }

        // ✅ Save to DB
        $curriculum = new IBDiploma();
        $curriculum->banner_heading = $validated['banner_heading'];
        $curriculum->banner_image = $bannerImage;
        $curriculum->inserted_by = Auth::id();
        $curriculum->inserted_at = Carbon::now();
        $curriculum->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-ib-diploma.index')
                        ->with('message', 'Curriculum details have been saved successfully.');
    }

    public function edit($id)
    {
        $curriculum = IBDiploma::findOrFail($id);
        return view('backend.academics.curriculum.diploma.edit', compact('curriculum'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Find the curriculum record
        $curriculum = IBDiploma::findOrFail($id);

        // ✅ Validation
        $validated = $request->validate([
            'banner_heading'   => 'required|string|max:255',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ], [
            'banner_heading.required' => 'Banner Heading is required.',
            'banner_heading.string'   => 'Banner Heading must be a valid string.',
            'banner_heading.max'      => 'Banner Heading cannot exceed 255 characters.',

            'image.image'             => 'The file must be an image.',
            'image.mimes'             => 'Only jpg, jpeg, png, webp, svg files are allowed.',
            'image.max'               => 'Maximum file size allowed is 2MB.',

        ]);

        // ✅ Handle Banner Image Upload (manual)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $bannerImage);

            // Delete old image if exists
            if ($curriculum->banner_image && file_exists(public_path('uploads/academics/' . $curriculum->banner_image))) {
                unlink(public_path('uploads/academics/' . $curriculum->banner_image));
            }

            $curriculum->banner_image = $bannerImage;
        }

        // ✅ Update other fields
        $curriculum->banner_heading   = $validated['banner_heading'];
        $curriculum->modified_by        = Auth::id();
        $curriculum->modified_at        = Carbon::now();
        
        $curriculum->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-ib-diploma.index')
                        ->with('message', 'Details have been updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = IBDiploma::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-ib-diploma.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}