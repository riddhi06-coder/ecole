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
use App\Models\Testimonial;

class TestimonialsController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::wherenull('deleted_by')->get();
        return view('backend.home.testimonials.index', compact('testimonials'));
    }


    public function create(Request $request)
    {
        return view('backend.home.testimonials.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate the form
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'reviewer' => 'required|string|max:255',
            'reviewer_details' => 'required|string|max:255',
            'bulletin_description' => 'required|string',
        ], [
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'reviewer.required' => 'Reviewer name is required.',
            'reviewer.string' => 'Reviewer name must be valid text.',
            'reviewer.max' => 'Reviewer name must not exceed 255 characters.',

            'reviewer_details.required' => 'Reviewer details are required.',
            'reviewer_details.string' => 'Reviewer details must be valid text.',
            'reviewer_details.max' => 'Reviewer details must not exceed 255 characters.',

            'bulletin_description.required' => 'Description is required.',
            'bulletin_description.string' => 'Description must be valid text.',
        ]);

        // ✅ Handle Image Upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/home'), $imageName);
        }

        // ✅ Save Data to DB
        $testimonial = new Testimonial();
        $testimonial->image = $imageName;
        $testimonial->reviewer = $validatedData['reviewer'];
        $testimonial->reviewer_details = $validatedData['reviewer_details'];
        $testimonial->description = $validatedData['bulletin_description']; 
        $testimonial->inserted_by = Auth::id();
        $testimonial->inserted_at = Carbon::now();
        $testimonial->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-testimonials.index')->with('message', 'Testimonial added successfully!');
    }

    
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.home.testimonials.edit', compact('testimonial'));
    }


    public function update(Request $request, $id)
    {
        // ✅ Find testimonial
        $testimonial = Testimonial::findOrFail($id);

        // ✅ Validate the form
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'reviewer' => 'required|string|max:255',
            'reviewer_details' => 'required|string|max:255',
            'bulletin_description' => 'required|string',
        ], [
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'reviewer.required' => 'Reviewer name is required.',
            'reviewer.string' => 'Reviewer name must be valid text.',
            'reviewer.max' => 'Reviewer name must not exceed 255 characters.',

            'reviewer_details.required' => 'Reviewer details are required.',
            'reviewer_details.string' => 'Reviewer details must be valid text.',
            'reviewer_details.max' => 'Reviewer details must not exceed 255 characters.',

            'bulletin_description.required' => 'Description is required.',
            'bulletin_description.string' => 'Description must be valid text.',
        ]);

        // ✅ Handle Image Upload (replace old image if new one uploaded)
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($testimonial->image && file_exists(public_path('uploads/home/' . $testimonial->image))) {
                unlink(public_path('uploads/home/' . $testimonial->image));
            }

            $file = $request->file('image');
            $imageName = time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/home'), $imageName);
            $testimonial->image = $imageName;
        }

        // ✅ Update fields
        $testimonial->reviewer = $validatedData['reviewer'];
        $testimonial->reviewer_details = $validatedData['reviewer_details'];
        $testimonial->description = $validatedData['bulletin_description'];
        $testimonial->modified_by = Auth::id();
        $testimonial->modified_at = Carbon::now();
        $testimonial->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-testimonials.index')->with('message', 'Testimonial updated successfully!');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Testimonial::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-testimonials.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}