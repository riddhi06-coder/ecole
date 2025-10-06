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
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UniversityPage;

class UniversityPageController extends Controller
{

    public function index()
    {
        $ib_learner = UniversityPage::wherenull('deleted_by')->get();
        return view('backend.academics.university.page.index', compact('ib_learner'));
    }

    public function create(Request $request)
    {
        return view('backend.academics.university.page.create');
    }

    public function store(Request $request){

        try {
            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'      => 'required|string|max:255',
                'image'               => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'     => 'required|string|max:255',
                'section_image'       => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_description' => 'required|string',
                'description'         => 'required|string',
            ], [
                'banner_heading.required'       => 'Description is required.',
                'image.required'       => 'Description is required.',
                'section_heading.required'       => 'Description is required.',
                'section_image.required'       => 'Description is required.',
                'section_description.required'       => 'Description is required.',

                'banner_heading.string'      => 'Banner heading must be a string.',
                'image.image'                => 'The banner must be an image file.',
                'image.mimes'                => 'Allowed banner formats: jpg, jpeg, png, webp, svg.',
                'image.max'                  => 'Banner image size must be less than 2MB.',
                'section_heading.string'     => 'Section heading must be a string.',
                'section_image.image'        => 'The section image must be a valid image file.',
                'section_image.mimes'        => 'Allowed section image formats: jpg, jpeg, png, webp, svg.',
                'section_image.max'          => 'Section image size must be less than 2MB.',
                'description.required'       => 'Description is required.',
            ]);


            // ✅ Handle Banner Image Upload
            $bannerName = null;
            if ($request->hasFile('image')) {
                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/academics'), $bannerName);
                Log::info('Banner image uploaded', ['banner' => $bannerName]);
            }

            // ✅ Handle Section Image Upload
            $sectionImageName = null;
            if ($request->hasFile('section_image')) {
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(1000, 9999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/academics'), $sectionImageName);
                Log::info('Section image uploaded', ['section_image' => $sectionImageName]);
            }


            // Handle optional document upload
            $documentName = null;
            if ($request->hasFile('document')) {
                $document = $request->file('document');
                $documentName = time() . '_' . rand(10, 999) . '.' . $document->getClientOriginalExtension();
                $document->move(public_path('uploads/academics'), $documentName);
            }

            // Optional URL
            $docUrl = $request->input('doc_url');


            // ✅ Store in Database
            $learnerProfile = new UniversityPage();
            $learnerProfile->banner_heading      = $validated['banner_heading'] ?? null;
            $learnerProfile->banner_image        = $bannerName ?? null;
            $learnerProfile->section_heading     = $validated['section_heading'] ?? null;
            $learnerProfile->section_image       = $sectionImageName ?? null;
            $learnerProfile->section_description = $validated['section_description'] ?? null;
            $learnerProfile->description         = $validated['description'];
            $learnerProfile->document = $documentName ?? null;
            $learnerProfile->url  = $docUrl ?? null;
            $learnerProfile->inserted_by         = Auth::id();
            $learnerProfile->inserted_at         = Carbon::now();
            $learnerProfile->save();


            // ✅ Success Message
            return redirect()->route('manage-university-page.index')
                ->with('message', 'Section added successfully!');

        } catch (\Exception $e) {
            // ❌ Error Handling & Logging
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $student_support = UniversityPage::findOrFail($id);
        return view('backend.academics.university.page.edit', compact('student_support'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        try {
            $validated = $request->validate([
                'banner_heading'      => 'required|string|max:255',
                'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_heading'     => 'required|string|max:255',
                'section_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'section_description' => 'required|string',
                'description'         => 'required|string',
                'document'            => 'nullable|file|mimes:pdf,doc,docx,xlsx|max:5120',
                'doc_url'             => 'nullable|url',
            ], [
                'banner_heading.required'       => 'Banner heading is required.',
                'image.image'                   => 'Banner must be an image file.',
                'image.mimes'                   => 'Allowed banner formats: jpg, jpeg, png, webp, svg.',
                'image.max'                     => 'Banner image size must be less than 2MB.',
                'section_heading.required'      => 'Section heading is required.',
                'section_image.image'           => 'Section image must be a valid image.',
                'section_image.mimes'           => 'Allowed section image formats: jpg, jpeg, png, webp, svg.',
                'section_image.max'             => 'Section image size must be less than 2MB.',
                'section_description.required'  => 'Section description is required.',
                'description.required'          => 'Description is required.',
                'document.mimes'                => 'Allowed document formats: PDF, DOC, DOCX, XLSX.',
                'document.max'                  => 'Document size must be less than 5MB.',
                'doc_url.url'                   => 'Please enter a valid URL.',
            ]);

            $studentSupport = UniversityPage::findOrFail($id);

            // Banner Image
            if ($request->hasFile('image')) {
                // Delete old banner if exists
                if ($studentSupport->banner_image && file_exists(public_path('uploads/academics/' . $studentSupport->banner_image))) {
                    unlink(public_path('uploads/academics/' . $studentSupport->banner_image));
                }
                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/academics'), $bannerName);
                $studentSupport->banner_image = $bannerName;
            }

            // Section Image
            if ($request->hasFile('section_image')) {
                if ($studentSupport->section_image && file_exists(public_path('uploads/academics/' . $studentSupport->section_image))) {
                    unlink(public_path('uploads/academics/' . $studentSupport->section_image));
                }
                $sectionImage = $request->file('section_image');
                $sectionImageName = time() . '_' . rand(1000, 9999) . '.' . $sectionImage->getClientOriginalExtension();
                $sectionImage->move(public_path('uploads/academics'), $sectionImageName);
                $studentSupport->section_image = $sectionImageName;
            }

            // Optional Document
            if ($request->hasFile('document')) {
                // If a new file is uploaded, delete old one first
                if ($studentSupport->document && file_exists(public_path('uploads/academics/' . $studentSupport->document))) {
                    unlink(public_path('uploads/academics/' . $studentSupport->document));
                }
                $document = $request->file('document');
                $documentName = time() . '_' . rand(10, 999) . '.' . $document->getClientOriginalExtension();
                $document->move(public_path('uploads/academics'), $documentName);
                $studentSupport->document = $documentName;
            } elseif ($request->input('remove_existing_doc') == 1) {
                // If the user clicked the cross and no new file is uploaded
                if ($studentSupport->document && file_exists(public_path('uploads/academics/' . $studentSupport->document))) {
                    unlink(public_path('uploads/academics/' . $studentSupport->document));
                }
                $studentSupport->document = null;
            }


            // Optional URL
            $studentSupport->url = $request->input('doc_url') ?? $studentSupport->url;

            // Update other fields
            $studentSupport->banner_heading      = $validated['banner_heading'];
            $studentSupport->section_heading     = $validated['section_heading'];
            $studentSupport->section_description = $validated['section_description'];
            $studentSupport->description         = $validated['description'];
            $studentSupport->modified_by          = Auth::id();
            $studentSupport->modified_at          = Carbon::now();

            $studentSupport->save();

            return redirect()->route('manage-university-page.index')
                ->with('message', 'Section updated successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = UniversityPage::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-university-page.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}
