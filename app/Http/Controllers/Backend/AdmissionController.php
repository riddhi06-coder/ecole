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
use App\Models\AdmissionProcedure;

class AdmissionController extends Controller
{

    public function index()
    {
        $admission = AdmissionProcedure::whereNull('deleted_by')->get();
        return view('backend.admission.criteria.index', compact('admission'));
    }

    public function create(Request $request)
    {
        return view('backend.admission.criteria.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate inputs
            $validated = $request->validate([
                'banner_heading' => 'nullable|string|max:255',
                'section_heading' => 'nullable|string|max:255',
                'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'policy_title'   => 'required|string|max:255',
                'description'    => 'nullable|string|max:5000',
                'policy'    => 'required|string|max:5000',
            ], [
                'policy_title.required' => 'Policy Title is required.',
                'policy.required'  => 'Description is required.',
                'image.image'           => 'Please upload a valid image file.',
                'image.mimes'           => 'Only jpg, jpeg, png, webp, svg files are allowed.',
                'image.max'             => 'Image must not be larger than 2MB.',
            ]);

            // ✅ Handle banner image upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admissions'), $imageName);
            }

            // ✅ Save to database
            $privacyPolicy = new AdmissionProcedure();
            $privacyPolicy->banner_heading = $request->banner_heading;
            $privacyPolicy->section_heading = $request->section_heading;
            $privacyPolicy->banner_image   = $imageName;
            $privacyPolicy->title   = $request->policy_title;
            $privacyPolicy->description    = $request->description;
            $privacyPolicy->procedure    = $request->policy;
            $privacyPolicy->inserted_by    = Auth::id();
            $privacyPolicy->inserted_at    = Carbon::now();
            $privacyPolicy->save();

            return redirect()->route('manage-admission-criteria.index')
                            ->with('message', 'Details saved successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; 
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $admission = AdmissionProcedure::findOrFail($id);
        return view('backend.admission.criteria.edit', compact('admission'));
    }

    public function update(Request $request, $id)
    {
        try {
            // ✅ Validate inputs
            $validated = $request->validate([
                'banner_heading' => 'nullable|string|max:255',
                'section_heading' => 'nullable|string|max:255',
                'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'policy_title'   => 'required|string|max:255',
                'description'    => 'nullable|string|max:5000',
                'policy'         => 'required|string|max:5000',
            ], [
                'policy_title.required' => 'Policy Title is required.',
                'policy.required'       => 'Description is required.',
                'image.image'           => 'Please upload a valid image file.',
                'image.mimes'           => 'Only jpg, jpeg, png, webp, svg files are allowed.',
                'image.max'             => 'Image must not be larger than 2MB.',
            ]);

            // ✅ Find existing record
            $admission = AdmissionProcedure::findOrFail($id);

            // ✅ Handle banner image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($admission->banner_image && file_exists(public_path('uploads/admissions/' . $admission->banner_image))) {
                    unlink(public_path('uploads/admissions/' . $admission->banner_image));
                }

                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admissions'), $imageName);

                $admission->banner_image = $imageName;
            }

            // ✅ Update other fields
            $admission->banner_heading = $request->banner_heading;
            $admission->section_heading = $request->section_heading;
            $admission->title          = $request->policy_title;
            $admission->description    = $request->description;
            $admission->procedure      = $request->policy;
            $admission->modified_by     = Auth::id();
            $admission->modified_at     = Carbon::now();

            $admission->save();

            return redirect()->route('manage-admission-criteria.index')
                            ->with('message', 'Details updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; 
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = AdmissionProcedure::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-admission-criteria.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}