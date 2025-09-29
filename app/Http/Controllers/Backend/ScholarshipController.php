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
use App\Models\MeritScholarship;

class ScholarshipController extends Controller
{

    public function index()
    {
        $merits = MeritScholarship::whereNull('deleted_by')->get();
        return view('backend.admission.scholarship.index', compact('merits'));
    }

    public function create(Request $request)
    {
        return view('backend.admission.scholarship.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate inputs
            $validated = $request->validate([
                'banner_heading'      => 'required|string|max:255',
                'image'               => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'     => 'required|string|max:255',
                'description'         => 'required|string|max:5000',
                'campus_tour'         => 'required|string|max:255',
                'admission_advisor'   => 'required|string|max:255',
                'brochure'            => 'required|mimes:pdf,doc,docx|max:2048', // 2MB max
            ], [
                'banner_heading.required'    => 'Banner Heading is required.',
                'image.required'             => 'Banner Image is required.',
                'image.image'                => 'Please upload a valid image file.',
                'image.mimes'                => 'Only jpg, jpeg, png, webp, svg files are allowed.',
                'image.max'                  => 'Banner Image must not exceed 2MB.',
                'section_heading.required'   => 'Section Heading is required.',
                'description.required'       => 'Details/Description is required.',
                'campus_tour.required'       => 'Campus Tour is required.',
                'admission_advisor.required' => 'Admission Advisor is required.',
                'brochure.required'          => 'School Brochure is required.',
                'brochure.mimes'             => 'Only PDF and Word files are allowed for the brochure.',
                'brochure.max'               => 'Brochure file must not exceed 2MB.',
            ]);

            // ✅ Handle banner image upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admissions'), $imageName);
            }

            // ✅ Handle brochure upload
            $brochureName = null;
            if ($request->hasFile('brochure')) {
                $brochure = $request->file('brochure');
                $brochureName = time() . '_' . rand(10, 999) . '.' . $brochure->getClientOriginalExtension();
                $brochure->move(public_path('uploads/admissions'), $brochureName);
            }

            // ✅ Save to database
            $merit = new MeritScholarship();
            $merit->banner_heading     = $request->banner_heading;
            $merit->banner_image       = $imageName;
            $merit->section_heading    = $request->section_heading;
            $merit->description        = $request->description;
            $merit->campus_tour        = $request->campus_tour;
            $merit->admission_advisor  = $request->admission_advisor;
            $merit->brochure           = $brochureName;
            $merit->inserted_by        = Auth::id();
            $merit->inserted_at        = Carbon::now();
            $merit->save();

            return redirect()->route('manage-merit-scholarships.index')
                            ->with('message', 'Merit Scholarship details saved successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $scholarship = MeritScholarship::findOrFail($id);
        return view('backend.admission.scholarship.edit', compact('scholarship'));
    }

    public function update(Request $request, $id)
    {
        try {
            // ✅ Find the existing record
            $merit = MeritScholarship::findOrFail($id);

            // ✅ Validate inputs
            $validated = $request->validate([
                'banner_heading'      => 'required|string|max:255',
                'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'     => 'required|string|max:255',
                'description'         => 'required|string|max:5000',
                'campus_tour'         => 'required|string|max:255',
                'admission_advisor'   => 'required|string|max:255',
                'brochure'            => 'nullable|mimes:pdf,doc,docx|max:2048', // 2MB max
            ], [
                'banner_heading.required'    => 'Banner Heading is required.',
                'image.image'                => 'Please upload a valid image file.',
                'image.mimes'                => 'Only jpg, jpeg, png, webp, svg files are allowed.',
                'image.max'                  => 'Banner Image must not exceed 2MB.',
                'section_heading.required'   => 'Section Heading is required.',
                'description.required'       => 'Details/Description is required.',
                'campus_tour.required'       => 'Campus Tour is required.',
                'admission_advisor.required' => 'Admission Advisor is required.',
                'brochure.mimes'             => 'Only PDF and Word files are allowed for the brochure.',
                'brochure.max'               => 'Brochure file must not exceed 2MB.',
            ]);

            // ✅ Handle banner image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($merit->banner_image && file_exists(public_path('uploads/admissions/' . $merit->banner_image))) {
                    unlink(public_path('uploads/admissions/' . $merit->banner_image));
                }

                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admissions'), $imageName);
                $merit->banner_image = $imageName;
            }

            // ✅ Handle brochure upload
            if ($request->hasFile('brochure')) {
                // Delete old brochure if exists
                if ($merit->brochure && file_exists(public_path('uploads/admissions/' . $merit->brochure))) {
                    unlink(public_path('uploads/admissions/' . $merit->brochure));
                }

                $brochure = $request->file('brochure');
                $brochureName = time() . '_' . rand(10, 999) . '.' . $brochure->getClientOriginalExtension();
                $brochure->move(public_path('uploads/admissions'), $brochureName);
                $merit->brochure = $brochureName;
            }

            // ✅ Update other fields
            $merit->banner_heading     = $request->banner_heading;
            $merit->section_heading    = $request->section_heading;
            $merit->description        = $request->description;
            $merit->campus_tour        = $request->campus_tour;
            $merit->admission_advisor  = $request->admission_advisor;
            $merit->modified_by         = Auth::id();
            $merit->modified_at         = Carbon::now();
            $merit->save();

            return redirect()->route('manage-merit-scholarships.index')
                            ->with('message', 'Merit Scholarship details updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = MeritScholarship::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-merit-scholarships.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}