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
use App\Models\FeeStructure;

class FeeStructureController extends Controller
{

    public function index()
    {
        $fees = FeeStructure::wherenull('deleted_by')->get(); 
        return view('backend.admission.fees.index', compact('fees'));
    }

    public function create(Request $request)
    {
        return view('backend.admission.fees.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate inputs
            $validated = $request->validate([
                'banner_heading'      => 'nullable|string|max:255',
                'thumbnail'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB max
                'section_heading'     => 'nullable|string|max:255',
                'section_description' => 'nullable|string|max:5000',
                'campus_tour'         => 'nullable|string|max:255',
                'admission_advisor'   => 'nullable|string|max:255',
                'brochure'            => 'nullable|mimes:pdf,doc,docx|max:2048', // 2MB max
                'fee_type'            => 'required|string|max:255',
                'fee_desc'            => 'nullable|string|max:500',
                'fees_details'        => 'required|string|max:5000',
            ], [
                'banner_heading.max'       => 'Banner Heading must not exceed 255 characters.',
                'thumbnail.image'          => 'Please upload a valid image file.',
                'thumbnail.mimes'          => 'Only jpg, jpeg, png, webp files are allowed.',
                'thumbnail.max'            => 'Banner Image must not exceed 2MB.',
                'section_heading.max'      => 'Section Heading must not exceed 255 characters.',
                'section_description.max'  => 'Section Description must not exceed 5000 characters.',
                'campus_tour.max'          => 'Campus Tour must not exceed 255 characters.',
                'admission_advisor.max'    => 'Admission Advisor must not exceed 255 characters.',
                'brochure.mimes'           => 'Only PDF and Word files are allowed for the brochure.',
                'brochure.max'             => 'Brochure file must not exceed 2MB.',
                'fee_type.required'        => 'Fee Type is required.',
                'fee_desc.required'        => 'Fees Description is required.',
                'fees_details.required'    => 'Fee Details are required.',
            ]);

            // ✅ Handle banner image upload
            $imageName = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
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
            $feeStructure = new FeeStructure();
            $feeStructure->banner_heading       = $request->banner_heading;
            $feeStructure->banner_image         = $imageName;
            $feeStructure->section_heading      = $request->section_heading;
            $feeStructure->section_description  = $request->section_description;
            $feeStructure->campus_tour          = $request->campus_tour;
            $feeStructure->admission_advisor    = $request->admission_advisor;
            $feeStructure->brochure             = $brochureName;
            $feeStructure->fee_type             = $request->fee_type;
            $feeStructure->fee_desc             = $request->fee_desc;
            $feeStructure->fees_details         = $request->fees_details;
            $feeStructure->inserted_by          = Auth::id();
            $feeStructure->inserted_at          = Carbon::now();
            $feeStructure->save();

            return redirect()->route('manage-fee-structure.index')
                            ->with('message', 'Fee Structure details saved successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve;

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $fee = FeeStructure::findOrFail($id); 
        $firstRecord = FeeStructure::whereNull('deleted_by')->first();
        return view('backend.admission.fees.edit', compact('fee', 'firstRecord'));
    }

    public function update(Request $request, $id)
    {
        try {
            // ✅ Fetch existing record
            $feeStructure = FeeStructure::findOrFail($id);

            // ✅ Validate inputs
            $validated = $request->validate([
                'banner_heading'      => 'nullable|string|max:255',
                'thumbnail'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'section_heading'     => 'nullable|string|max:255',
                'section_description' => 'nullable|string|max:5000',
                'campus_tour'         => 'nullable|string|max:255',
                'admission_advisor'   => 'nullable|string|max:255',
                'brochure'            => 'nullable|mimes:pdf,doc,docx|max:2048',
                'fee_type'            => 'required|string|max:255',
                'fee_desc'            => 'nullable|string|max:500',
                'fees_details'        => 'required|string|max:5000',
            ], [
                'banner_heading.max'       => 'Banner Heading must not exceed 255 characters.',
                'thumbnail.image'          => 'Please upload a valid image file.',
                'thumbnail.mimes'          => 'Only jpg, jpeg, png, webp files are allowed.',
                'thumbnail.max'            => 'Banner Image must not exceed 2MB.',
                'section_heading.max'      => 'Section Heading must not exceed 255 characters.',
                'section_description.max'  => 'Section Description must not exceed 5000 characters.',
                'campus_tour.max'          => 'Campus Tour must not exceed 255 characters.',
                'admission_advisor.max'    => 'Admission Advisor must not exceed 255 characters.',
                'brochure.mimes'           => 'Only PDF and Word files are allowed for the brochure.',
                'brochure.max'             => 'Brochure file must not exceed 2MB.',
                'fee_type.required'        => 'Fee Type is required.',
                'fee_desc.required'        => 'Fees Description is required.',
                'fees_details.required'    => 'Fee Details are required.',
            ]);

            // ✅ Handle banner image upload
            if ($request->hasFile('thumbnail')) {
                // Delete old image if exists
                if ($feeStructure->banner_image && file_exists(public_path('uploads/admissions/'.$feeStructure->banner_image))) {
                    unlink(public_path('uploads/admissions/'.$feeStructure->banner_image));
                }

                $image = $request->file('thumbnail');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admissions'), $imageName);
                $feeStructure->banner_image = $imageName;
            }

            // ✅ Handle brochure upload
            if ($request->hasFile('brochure')) {
                // Delete old brochure if exists
                if ($feeStructure->brochure && file_exists(public_path('uploads/admissions/'.$feeStructure->brochure))) {
                    unlink(public_path('uploads/admissions/'.$feeStructure->brochure));
                }

                $brochure = $request->file('brochure');
                $brochureName = time() . '_' . rand(10, 999) . '.' . $brochure->getClientOriginalExtension();
                $brochure->move(public_path('uploads/admissions'), $brochureName);
                $feeStructure->brochure = $brochureName;
            }

            // ✅ Update remaining fields
            $feeStructure->banner_heading       = $request->banner_heading;
            $feeStructure->section_heading      = $request->section_heading;
            $feeStructure->section_description  = $request->section_description;
            $feeStructure->campus_tour          = $request->campus_tour;
            $feeStructure->admission_advisor    = $request->admission_advisor;
            $feeStructure->fee_type             = $request->fee_type;
            $feeStructure->fee_desc             = $request->fee_desc;
            $feeStructure->fees_details         = $request->fees_details;
            $feeStructure->modified_by           = Auth::id();
            $feeStructure->modified_at           = Carbon::now();
            $feeStructure->save();

            return redirect()->route('manage-fee-structure.index')
                            ->with('message', 'Fee Structure details updated successfully.');

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
            $industries = FeeStructure::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-fee-structure.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}