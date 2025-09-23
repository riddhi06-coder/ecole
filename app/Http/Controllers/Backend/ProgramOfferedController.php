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
use App\Models\ProgrammeOffered;

class ProgramOfferedController extends Controller
{

    public function index()
    {
        $programmes = ProgrammeOffered::whereNull('deleted_at')->get();
        return view('backend.home.program_offered.index', compact('programmes'));
    }

    public function create(Request $request)
    {
        return view('backend.home.program_offered.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate the request
        $validatedData = $request->validate([
            'section_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'program' => 'required|string|max:255',
            'url' => 'required|url',
            'program_description' => 'required|string',
        ], [
            'section_title.string' => 'Section title must be a valid text.',
            'description.string' => 'Description must be valid text.',

            'image.required' => 'Programme image is required.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'program.required' => 'Program name is required.',
            'program.string' => 'Program name must be valid text.',

            'url.required' => 'Contact URL is required.',
            'url.url' => 'Please enter a valid URL (e.g., https://example.com).',

            'program_description.required' => 'Program description is required.',
            'program_description.string' => 'Program description must be valid text.',
        ]);

        // ✅ Handle Image Upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $imageName);
        }

        // ✅ Save data in DB
        $programme = new ProgrammeOffered();
        $programme->section_title = $validatedData['section_title'] ?? null;
        $programme->description = $validatedData['description'] ?? null;
        $programme->image = $imageName ? $imageName : null;
        $programme->program = $validatedData['program'];
        $programme->url = $validatedData['url'];
        $programme->program_description = $validatedData['program_description'];
        $programme->inserted_by = Auth::id();
        $programme->inserted_at = Carbon::now();
        $programme->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-programme-offered.index')
            ->with('message', 'Programme Offered has been added successfully!');
    }

    public function edit($id)
    {
        $program_offered = ProgrammeOffered::findOrFail($id);
        return view('backend.home.program_offered.edit', compact('program_offered'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the existing record
        $programme = ProgrammeOffered::findOrFail($id);

        // ✅ Validate the request
        $validatedData = $request->validate([
            'section_title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048', 
            'program' => 'required|string|max:255',
            'url' => 'required|url',
            'program_description' => 'required|string',
        ], [
            'section_title.string' => 'Section title must be a valid text.',
            'description.string' => 'Description must be valid text.',

            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'program.required' => 'Program name is required.',
            'program.string' => 'Program name must be valid text.',

            'url.required' => 'Contact URL is required.',
            'url.url' => 'Please enter a valid URL (e.g., https://example.com).',

            'program_description.required' => 'Program description is required.',
            'program_description.string' => 'Program description must be valid text.',
        ]);

        // ✅ Handle Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $imageName);

            // Delete old image if exists
            if ($programme->image && file_exists(public_path('uploads/home/' . $programme->image))) {
                unlink(public_path('uploads/home/' . $programme->image));
            }

            $programme->image = $imageName;
        }

        // ✅ Update data in DB
        $programme->section_title = $validatedData['section_title'] ?? null;
        $programme->description = $validatedData['description'] ?? null;
        $programme->program = $validatedData['program'];
        $programme->url = $validatedData['url'];
        $programme->program_description = $validatedData['program_description'];
        $programme->modified_by = Auth::id();
        $programme->modified_at = Carbon::now();
        $programme->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-programme-offered.index')
            ->with('message', 'Programme Offered has been updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProgrammeOffered::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-programme-offered.index')->with('message', 'Programs deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}