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
use App\Models\HomeFestivities;

class FestivitiesController extends Controller
{

    public function index()
    {
        $festivities = HomeFestivities::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        return view('backend.home.festivities.index', compact('festivities'));
    }

    public function create(Request $request)
    {
        return view('backend.home.festivities.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate the request
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'image.required' => 'Festivity image is required.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'heading.required' => 'Heading is required.',
            'heading.string' => 'Heading must be valid text.',
            'heading.max' => 'Heading must not exceed 255 characters.',

            'description.required' => 'Description is required.',
            'description.string' => 'Description must be valid text.',
        ]);

        // ✅ Handle Image Upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home/festivities'), $imageName); // Store in a separate folder
        }


        // ✅ Generate slug from heading
        $slug = Str::slug($validatedData['heading']);

        // ✅ Save data in DB
        $festivity = new HomeFestivities();
        $festivity->image = $imageName;
        $festivity->heading = $validatedData['heading'];
        $festivity->slug = $slug; // store slug
        $festivity->description = $validatedData['description'];
        $festivity->inserted_by = Auth::id();
        $festivity->inserted_at = Carbon::now();
        $festivity->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-home-festivities.index')
            ->with('message', 'Home Festivity has been added successfully!');
    }

    public function edit($id)
    {
        $festivities = HomeFestivities::findOrFail($id);
        return view('backend.home.festivities.edit', compact('festivities'));
    }

    public function update(Request $request, $id)
    {
        // ✅ Find the existing record
        $festivity = HomeFestivities::findOrFail($id);

        // ✅ Validate the request
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'heading.required' => 'Heading is required.',
            'heading.string' => 'Heading must be valid text.',
            'heading.max' => 'Heading must not exceed 255 characters.',

            'description.required' => 'Description is required.',
            'description.string' => 'Description must be valid text.',
        ]);

        // ✅ Handle Image Upload (replace existing if new file provided)
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (!empty($festivity->image) && file_exists(public_path('uploads/home/festivities/' . $festivity->image))) {
                unlink(public_path('uploads/home/festivities/' . $festivity->image));
            }

            $image = $request->file('image');
            $imageName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home/festivities'), $imageName);
            $festivity->image = $imageName;
        }

        // ✅ Generate slug from heading
        $festivity->slug = Str::slug($validatedData['heading']);

        // ✅ Update other fields
        $festivity->heading = $validatedData['heading'];
        $festivity->description = $validatedData['description'];
        $festivity->modified_by = Auth::id();
        $festivity->modified_at = Carbon::now();
        $festivity->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-home-festivities.index')
            ->with('message', 'Home Festivity has been updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeFestivities::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-home-festivities.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}