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
use App\Models\Policy;

class PolicyController extends Controller
{

    public function index()
    {
        $policy = Policy::wherenull('deleted_by')->get();
        return view('backend.academics.policy.index', compact('policy'));
    }

    public function create(Request $request)
    {
        return view('backend.academics.policy.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'image'           => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'      => 'required|string|max:255',
            'doc_names.*'         => 'required|string|max:255',
            'doc_files.*'         => 'required|mimes:pdf,doc,docx|max:2048',
        ], [
            'image.required'       => 'Please upload a banner image.',
            'image.image'          => 'Banner must be a valid image.',
            'banner_heading.required'  => 'Please enter a banner heading.',
            'doc_names.*.required'     => 'Please enter each document name.',
            'doc_files.*.required'     => 'Please upload each document file.',
        ]);

        // ✅ Store Banner Image
        $bannerImage = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $bannerImage);
        }

        // ✅ Store Documents (Multiple rows)
        $documents = [];
        if ($request->has('doc_names')) {
            foreach ($request->doc_names as $index => $docName) {
                $docFileName = null;
                if (isset($request->doc_files[$index])) {
                    $docFile = $request->doc_files[$index];
                    $docFileName = time() . rand(100000, 999999) . '.' . $docFile->getClientOriginalExtension();
                    $docFile->move(public_path('uploads/academics'), $docFileName);
                }
                $documents[] = [
                    'name' => $docName,
                    'file' => $docFileName,
                ];
            }
        }

        // ✅ Save to Database
        $university = new Policy();
        $university->banner_image = $bannerImage;
        $university->banner_heading = $request->banner_heading;
        $university->documents = json_encode($documents);
        $university->inserted_by = Auth::id();
        $university->inserted_at = Carbon::now();
        $university->save();

        // ✅ Redirect with Success Message
        return redirect()->route('manage-policies.index')->with('message', 'Policy details added successfully!');
    }

    public function edit($id)
    {
        $university = Policy::findOrFail($id);
        return view('backend.academics.policy.edit', compact('university'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Find the record
        $university = Policy::findOrFail($id);

        // ✅ Validation
        $request->validate([
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_heading'      => 'required|string|max:255',
            'doc_names.*'         => 'required|string|max:255',
            'doc_files.*'         => 'nullable|mimes:pdf,doc,docx|max:2048',
        ], [
            'banner_heading.required'  => 'Please enter a banner heading.',
            'doc_names.*.required'     => 'Please enter each document name.',
        ]);

        // ✅ Update Banner Image if new uploaded
        if ($request->hasFile('image')) {
            // Delete old banner if exists
            if ($university->banner_image && file_exists(public_path('uploads/academics/'.$university->banner_image))) {
                unlink(public_path('uploads/academics/'.$university->banner_image));
            }

            $image = $request->file('image');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/academics'), $bannerImage);
            $university->banner_image = $bannerImage;
        }

        // ✅ Update Documents
        $documents = [];
        if ($request->has('doc_names')) {
            $existingFiles = $request->existing_doc_file ?? []; // hidden inputs

            foreach ($request->doc_names as $index => $docName) {
                $docFileName = $existingFiles[$index] ?? null;

                // If new file uploaded, replace it
                if (isset($request->doc_files[$index]) && $request->doc_files[$index]) {
                    $docFile = $request->doc_files[$index];

                    // Delete old file if exists
                    if ($docFileName && file_exists(public_path('uploads/academics/' . $docFileName))) {
                        unlink(public_path('uploads/academics/' . $docFileName));
                    }

                    $docFileName = time() . rand(100000, 999999) . '.' . $docFile->getClientOriginalExtension();
                    $docFile->move(public_path('uploads/academics'), $docFileName);
                }

                // Only add to array if name or file exists (prevents empty rows)
                if ($docName || $docFileName) {
                    $documents[] = [
                        'name' => $docName,
                        'file' => $docFileName,
                    ];
                }
            }
        }

        // ✅ Update Other Fields
        $university->banner_heading = $request->banner_heading;
        $university->documents = json_encode($documents);
        $university->modified_by = Auth::id();
        $university->modified_at = Carbon::now();
        $university->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-policies.index')->with('message', 'Policy details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Policy::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-policies.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}
