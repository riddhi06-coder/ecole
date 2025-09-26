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
use App\Models\AboutTestimonial;

class AboutTestimonialsController extends Controller
{

    
    public function index()
    {
        $records = AboutTestimonial::wherenull('deleted_by')->get();
        return view('backend.about.testimonial.index', compact('records'));
    }

    public function create(Request $request)
    {
        return view('backend.about.testimonial.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate inputs
        $validatedData = $request->validate([
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'   => 'nullable|string|max:255',
            'section_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'  => 'nullable|string|max:255',
            'reviewer'         => 'required|string|max:255',
            'testimony'        => 'required|string',
        ], [
            'thumbnail.image'        => 'Please upload a valid Banner image.',
            'banner_heading.string'  => 'Banner heading must be a string.',
            'section_image.image'    => 'Please upload a valid Section image.',
            'section_heading.string' => 'Section heading must be a string.',
            'reviewer.required'      => 'Please enter Reviewer.',
            'testimony.required'     => 'Please enter Testimony.',
        ]);

        // ✅ Handle Banner Image upload
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerImage);
        }

        // ✅ Handle Section Image upload
        $sectionImage = null;
        if ($request->hasFile('section_image')) {
            $image = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage);
        }

        // ✅ Save to DB
        $testimonial = new AboutTestimonial(); // Assuming model name is Testimonial
        $testimonial->banner_image       = $bannerImage;
        $testimonial->banner_heading     = $validatedData['banner_heading'] ?? null;
        $testimonial->section_image      = $sectionImage;
        $testimonial->section_heading    = $validatedData['section_heading'] ?? null;
        $testimonial->reviewer           = $validatedData['reviewer'];
        $testimonial->testimony          = $validatedData['testimony'];
        $testimonial->inserted_by        = Auth::id();
        $testimonial->inserted_at        = Carbon::now();
        $testimonial->save();

        return redirect()->route('manage-about-testimonials.index')->with('message', 'Testimonial added successfully.');
    }

    public function edit($id)
    {
        $set_apart = AboutTestimonial::findOrFail($id);
        return view('backend.about.testimonial.edit', compact('set_apart'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = AboutTestimonial::findOrFail($id);

        // ✅ Validate inputs
        $validatedData = $request->validate([
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'   => 'nullable|string|max:255',
            'section_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'  => 'nullable|string|max:255',
            'reviewer'         => 'required|string|max:255',
            'testimony'        => 'required|string',
        ], [
            'thumbnail.image'        => 'Please upload a valid Banner image.',
            'banner_heading.string'  => 'Banner heading must be a string.',
            'section_image.image'    => 'Please upload a valid Section image.',
            'section_heading.string' => 'Section heading must be a string.',
            'reviewer.required'      => 'Please enter Reviewer.',
            'testimony.required'     => 'Please enter Testimony.',
        ]);

        // ✅ Handle Banner Image upload (replace old if new uploaded)
        if ($request->hasFile('thumbnail')) {
            // Delete old banner image if exists
            if (!empty($testimonial->banner_image) && file_exists(public_path('uploads/about/' . $testimonial->banner_image))) {
                unlink(public_path('uploads/about/' . $testimonial->banner_image));
            }

            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $bannerImage);
            $testimonial->banner_image = $bannerImage;
        }

        // ✅ Handle Section Image upload (replace old if new uploaded)
        if ($request->hasFile('section_image')) {
            // Delete old section image if exists
            if (!empty($testimonial->section_image) && file_exists(public_path('uploads/about/' . $testimonial->section_image))) {
                unlink(public_path('uploads/about/' . $testimonial->section_image));
            }

            $image = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $sectionImage);
            $testimonial->section_image = $sectionImage;
        }

        // ✅ Update other fields
        $testimonial->banner_heading    = $validatedData['banner_heading'] ?? $testimonial->banner_heading;
        $testimonial->section_heading   = $validatedData['section_heading'] ?? $testimonial->section_heading;
        $testimonial->reviewer          = $validatedData['reviewer'];
        $testimonial->testimony         = $validatedData['testimony'];
        $testimonial->modified_by        = Auth::id();
        $testimonial->modified_at        = Carbon::now();
        $testimonial->save();

        return redirect()->route('manage-about-testimonials.index')->with('message', 'Testimonial updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = AboutTestimonial::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-about-testimonials.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}