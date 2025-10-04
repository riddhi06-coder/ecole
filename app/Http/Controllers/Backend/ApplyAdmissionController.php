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
use App\Models\ApplyAdmission;

class ApplyAdmissionController extends Controller
{

    
    public function index()
    {
        $admissions = ApplyAdmission::orderBy('id', 'asc')->wherenull('deleted_by')->get();
        return view('backend.admission.apply_admission.index', compact('admissions'));
    }

    public function create(Request $request)
    {
        return view('backend.admission.apply_admission.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'image'          => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description'    => 'required|string',
        ], [
            'banner_heading.required' => 'Banner heading is required.',
            'image.required'          => 'A banner image is required.',
            'image.image'             => 'The file must be an image.',
            'image.mimes'             => 'Only jpg, jpeg, png, webp, svg formats are allowed.',
            'image.max'               => 'The image size must be less than 2MB.',
            'description.required'    => 'Description is required.',
        ]);

        try {
            // ✅ Handle banner image upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/campus-life'), $imageName);
            }

            // ✅ Save to DB (assuming model is ApplyAdmission)
            ApplyAdmission::create([
                'banner_heading' => $request->banner_heading,
                'banner_image'   => $imageName,
                'description'    => $request->description,
                'created_by'     => auth()->id() ?? null,
            ]);

            return redirect()->route('manage-apply-admission.index')
                ->with('messge', 'Admission details added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $admission = ApplyAdmission::findOrFail($id);
        return view('backend.admission.apply_admission.edit', compact('admission'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Validate input
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description'    => 'required|string',
        ], [
            'banner_heading.required' => 'Banner heading is required.',
            'image.image'             => 'The file must be an image.',
            'image.mimes'             => 'Only jpg, jpeg, png, webp, svg formats are allowed.',
            'image.max'               => 'The image size must be less than 2MB.',
            'description.required'    => 'Description is required.',
        ]);

        try {
            // ✅ Find existing record
            $admission = ApplyAdmission::findOrFail($id);

            // ✅ Handle new image upload (if provided)
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($admission->banner_image && file_exists(public_path('uploads/campus-life/' . $admission->banner_image))) {
                    unlink(public_path('uploads/campus-life/' . $admission->banner_image));
                }

                $image = $request->file('image');
                $imageName = time() . '_' . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/campus-life'), $imageName);
                $admission->banner_image = $imageName;
            }

            // ✅ Update other fields
            $admission->banner_heading = $request->banner_heading;
            $admission->description    = $request->description;
            $admission->modified_by    = Auth::id() ?? null;
            $admission->modified_at    = Carbon::now() ?? null;
            $admission->save();

            return redirect()->route('manage-apply-admission.index')
                ->with('message', 'Admission details updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ApplyAdmission::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-apply-admission.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}