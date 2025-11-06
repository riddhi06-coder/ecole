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
use App\Models\BrochureDetail;

class BrochureDetailsController extends Controller
{

    public function index()
    {
         // Fetch all records
        $brochures = BrochureDetail::orderBy('id', 'asc')->wherenull('deleted_by')->get();
        return view('backend.brochure.index', compact('brochures'));
    }

    public function create(Request $request)
    {
        return view('backend.brochure.create');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validation
        $request->validate([
            'brochure' => 'required|mimes:pdf|max:3072', // 3MB = 3072 KB
            'passport_type' => 'required|array',
            'passport_type.*' => 'in:1,2',
            'amount' => 'required|array',
            'amount.*' => 'numeric|min:0',
        ]);

        // ✅ Ensure unique passport types
        if (count($request->passport_type) !== count(array_unique($request->passport_type))) {
            return back()
                ->withInput()
                ->withErrors(['passport_type' => 'Each passport type can only be added once.']);
        }

        // ✅ Step 2: Handle Brochure Upload
        $brochurePath = null;

        if ($request->hasFile('brochure')) {
            $file = $request->file('brochure');

            // Replace spaces and special characters with hyphens
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $safeName = preg_replace('/[^A-Za-z0-9\-]/', '-', str_replace(' ', '-', $originalName));

            // Combine to form final safe filename
            $filename = $safeName . '.' . $extension;

            // Move file to public/uploads/brochures
            $file->move(public_path('uploads/brochures'), $filename);

            // Save relative path for database
            $brochurePath = 'uploads/brochures/' . $filename;
        }



        // ✅ Step 3: Prepare Fees Data (JSON)
        $fees = [];
        foreach ($request->passport_type as $index => $type) {
            $fees[] = [
                'passport_type' => $type,
                'amount' => $request->amount[$index] ?? 0,
            ];
        }

        // ✅ Step 4: Store in Database using Model
        $brochure = new BrochureDetail();
        $brochure->brochure = $brochurePath;
        $brochure->fees = json_encode($fees);
        $brochure->inserted_at = Carbon::now();
        $brochure->inserted_by = Auth::user()->id ?? null; // store user ID
        $brochure->save();


        // ✅ Step 5: Redirect with Success
        return redirect()
            ->route('manage-brochure-details.index')
            ->with('success', 'Brochure details added successfully!');
    }

    public function edit($id)
    {
        $brochure = BrochureDetail::findOrFail($id);
        return view('backend.brochure.edit', compact('brochure'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Step 1: Validation
        $request->validate([
            'brochure' => 'nullable|mimes:pdf|max:3072', // optional during edit
            'passport_type' => 'required|array',
            'passport_type.*' => 'in:1,2',
            'amount' => 'required|array',
            'amount.*' => 'numeric|min:0',
        ]);

        // ✅ Ensure unique passport types
        if (count($request->passport_type) !== count(array_unique($request->passport_type))) {
            return back()
                ->withInput()
                ->withErrors(['passport_type' => 'Each passport type can only be added once.']);
        }

        // ✅ Step 2: Find Brochure Record
        $brochure = BrochureDetail::findOrFail($id);

        // ✅ Step 3: Handle Brochure Upload (if new file provided)
        if ($request->hasFile('brochure')) {
            $file = $request->file('brochure');

            // Replace spaces and special characters with hyphens
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $safeName = preg_replace('/[^A-Za-z0-9\-]/', '-', str_replace(' ', '-', $originalName));
            $filename = $safeName . '.' . $extension;

            // Move new file to uploads directory
            $file->move(public_path('uploads/brochures'), $filename);

            // Delete old brochure file if exists
            if (!empty($brochure->brochure) && file_exists(public_path($brochure->brochure))) {
                unlink(public_path($brochure->brochure));
            }

            // Update with new path
            $brochure->brochure = 'uploads/brochures/' . $filename;
        }

        // ✅ Step 4: Update Fees (as JSON)
        $fees = [];
        foreach ($request->passport_type as $index => $type) {
            $fees[] = [
                'passport_type' => $type,
                'amount' => $request->amount[$index] ?? 0,
            ];
        }

        $brochure->fees = json_encode($fees);

        // ✅ Step 5: Update meta fields
        $brochure->modified_at = Carbon::now();
        $brochure->modified_by = Auth::user()->id ?? null;

        $brochure->save();

        // ✅ Step 6: Redirect with success message
        return redirect()
            ->route('manage-brochure-details.index')
            ->with('success', 'Brochure details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BrochureDetail::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-brochure-detailsindex')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}