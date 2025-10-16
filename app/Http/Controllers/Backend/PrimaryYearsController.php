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
use App\Models\Pyp;

class PrimaryYearsController extends Controller
{
 
    public function index()
    {
        $curriculum = Pyp::wherenull('deleted_by')->get();
        return view('backend.academics.pyp.index', compact('curriculum'));
    }

    public function create(Request $request)
    {
        return view('backend.academics.pyp.create');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate all input fields
        $validatedData = $request->validate([
            'banner_heading'          => 'required|string|max:255',
            'image'                   => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'section_heading'         => 'required|string|max:255',
            'section_image'           => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'small_intro'             => 'required|string',
            'program_heading'         => 'required|string|max:255',
            'program_image'           => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'program_description'     => 'required|string',
            'framework_heading'       => 'required|string|max:255',
            'framework_image'         => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'curriculum_description'  => 'required|string',
            'extra_info'              => 'required|string',
            'document'                => 'nullable|file|mimes:pdf,doc,docx,xlsx|max:5120',
            'doc_url'                 => 'nullable|url',
        ], [
            'banner_heading.required'         => 'Please enter a banner heading.',
            'image.required'                  => 'Please upload a banner image.',
            'image.mimes'                     => 'Allowed banner image formats: JPG, JPEG, PNG, WEBP, SVG.',
            'image.max'                       => 'Banner image must be less than 2MB.',
            'section_heading.required'        => 'Please enter a section heading.',
            'section_image.required'          => 'Please upload a section image.',
            'section_image.mimes'             => 'Allowed section image formats: JPG, JPEG, PNG, WEBP, SVG.',
            'program_heading.required'        => 'Please enter a program heading.',
            'program_image.required'          => 'Please upload a program image.',
            'framework_heading.required'      => 'Please enter a curriculum framework heading.',
            'framework_image.required'        => 'Please upload a curriculum framework image.',
            'curriculum_description.required' => 'Please enter the curriculum description.',
            'extra_info.required'             => 'Please enter extra information.',
            'document.mimes'                  => 'Document must be in PDF, DOC, DOCX, or XLSX format.',
            'document.max'                    => 'Document size must not exceed 5MB.',
            'doc_url.url'                     => 'Please enter a valid URL for the document link.',
        ]);

        // ✅ Step 2: Handle image uploads
        $bannerImage = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $bannerImage);
        }

        $sectionImage = null;
        if ($request->hasFile('section_image')) {
            $image = $request->file('section_image');
            $sectionImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $sectionImage);
        }

        $programImage = null;
        if ($request->hasFile('program_image')) {
            $image = $request->file('program_image');
            $programImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $programImage);
        }

        $frameworkImage = null;
        if ($request->hasFile('framework_image')) {
            $image = $request->file('framework_image');
            $frameworkImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $frameworkImage);
        }

        $documentFile = null;
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $documentFile = time() . rand(10, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/academics/documents'), $documentFile);
        }

        // ✅ Step 3: Save data to database
        $pyp = new Pyp();
        $pyp->banner_heading          = $validatedData['banner_heading'];
        $pyp->banner_image            = $bannerImage;
        $pyp->section_heading         = $validatedData['section_heading'];
        $pyp->section_image           = $sectionImage;
        $pyp->small_intro             = $validatedData['small_intro'];
        $pyp->program_heading         = $validatedData['program_heading'];
        $pyp->program_image           = $programImage;
        $pyp->program_description     = $validatedData['program_description'];
        $pyp->framework_heading       = $validatedData['framework_heading'];
        $pyp->framework_image         = $frameworkImage;
        $pyp->curriculum_description  = $validatedData['curriculum_description'];
        $pyp->extra_info              = $validatedData['extra_info'];
        $pyp->document                = $documentFile;
        $pyp->doc_url                 = $validatedData['doc_url'] ?? null;
        $pyp->inserted_by             = Auth::id() ?? null;
        $pyp->inserted_at             = Carbon::now() ?? null;
        $pyp->save();

        // ✅ Step 4: Redirect with success message
        return redirect()->route('manage-pyp.index')
            ->with('message', 'Program details have been successfully saved!');
    }

    public function edit($id)
    {
        $curriculum = Pyp::findOrFail($id);
        return view('backend.academics.pyp.edit', compact('curriculum'));
    }

    public function update(Request $request, $id)
    {
        $pyp = Pyp::findOrFail($id);

        // ✅ Step 1: Validate input
        $validatedData = $request->validate([
            'banner_heading'          => 'required|string|max:255',
            'image'                   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'section_heading'         => 'required|string|max:255',
            'section_image'           => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'small_intro'             => 'required|string',
            'program_heading'         => 'required|string|max:255',
            'program_image'           => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'program_description'     => 'required|string',
            'framework_heading'       => 'required|string|max:255',
            'framework_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'curriculum_description'  => 'required|string',
            'extra_info'              => 'required|string',
            'document'                => 'nullable|file|mimes:pdf,doc,docx,xlsx|max:5120',
            'doc_url'                 => 'nullable|url',
        ]);

        // ✅ Step 2: Handle image uploads (replace old files if new uploaded)
        if ($request->hasFile('image')) {
            if ($pyp->banner_image && file_exists(public_path('uploads/academics/'.$pyp->banner_image))) {
                unlink(public_path('uploads/academics/'.$pyp->banner_image));
            }
            $image = $request->file('image');
            $pyp->banner_image = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $pyp->banner_image);
        }

        if ($request->hasFile('section_image')) {
            if ($pyp->section_image && file_exists(public_path('uploads/academics/'.$pyp->section_image))) {
                unlink(public_path('uploads/academics/'.$pyp->section_image));
            }
            $image = $request->file('section_image');
            $pyp->section_image = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $pyp->section_image);
        }

        if ($request->hasFile('program_image')) {
            if ($pyp->program_image && file_exists(public_path('uploads/academics/'.$pyp->program_image))) {
                unlink(public_path('uploads/academics/'.$pyp->program_image));
            }
            $image = $request->file('program_image');
            $pyp->program_image = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $pyp->program_image);
        }

        if ($request->hasFile('framework_image')) {
            if ($pyp->framework_image && file_exists(public_path('uploads/academics/'.$pyp->framework_image))) {
                unlink(public_path('uploads/academics/'.$pyp->framework_image));
            }
            $image = $request->file('framework_image');
            $pyp->framework_image = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $pyp->framework_image);
        }

        // If user clicked ❌ to remove old document
        if ($request->input('remove_document') == 1) {
            if ($pyp->document && file_exists(public_path('uploads/academics/documents/'.$pyp->document))) {
                unlink(public_path('uploads/academics/documents/'.$pyp->document));
            }
            $pyp->document = null;
        }

        // If new document uploaded, replace old one
        if ($request->hasFile('document')) {
            if ($pyp->document && file_exists(public_path('uploads/academics/documents/'.$pyp->document))) {
                unlink(public_path('uploads/academics/documents/'.$pyp->document));
            }
            $file = $request->file('document');
            $pyp->document = time() . rand(10, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/academics/documents'), $pyp->document);
        }

        // ✅ Step 3: Update database fields
        $pyp->banner_heading         = $validatedData['banner_heading'];
        $pyp->section_heading        = $validatedData['section_heading'];
        $pyp->small_intro            = $validatedData['small_intro'];
        $pyp->program_heading        = $validatedData['program_heading'];
        $pyp->program_description    = $validatedData['program_description'];
        $pyp->framework_heading      = $validatedData['framework_heading'];
        $pyp->curriculum_description = $validatedData['curriculum_description'];
        $pyp->extra_info             = $validatedData['extra_info'];
        $pyp->doc_url                = $validatedData['doc_url'] ?? null;
        $pyp->modified_by            = Auth::id() ?? null;
        $pyp->modified_at            = Carbon::now();
        $pyp->save();

        // ✅ Step 4: Redirect with success message
        return redirect()->route('manage-pyp.index')
                        ->with('message', 'Program details have been successfully updated!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Pyp::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-pyp.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}