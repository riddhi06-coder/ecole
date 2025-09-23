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
use App\Models\HomeFeatures;

class FeaturesController extends Controller
{

    public function index()
    {
        $homeFeatures = HomeFeatures::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        return view('backend.home.features.index', compact('homeFeatures'));
    }

    public function create(Request $request)
    {
        return view('backend.home.features.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate the main form and features
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description' => 'required|string',
            'features' => 'required|array|min:1',
            'features.*.image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'features.*.name' => 'required|string|max:255',
        ], [
            'image.required' => 'Background image is required.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'image.max' => 'Image size must not exceed 2MB.',

            'description.required' => 'Description is required.',
            'description.string' => 'Description must be valid text.',

            'features.required' => 'At least one feature is required.',
            'features.*.image.required' => 'Feature image is required.',
            'features.*.image.image' => 'Feature must be a valid image.',
            'features.*.image.mimes' => 'Feature image must be JPG, JPEG, PNG, WEBP, or SVG.',
            'features.*.image.max' => 'Feature image must not exceed 2MB.',
            'features.*.name.required' => 'Feature name is required.',
            'features.*.name.string' => 'Feature name must be valid text.',
            'features.*.name.max' => 'Feature name must not exceed 255 characters.',
        ]);

        // ✅ Handle Background Image Upload
        $bgImageName = null;
        if ($request->hasFile('image')) {
            $bgImage = $request->file('image');
            $bgImageName = time() . rand(100, 999) . '.' . $bgImage->getClientOriginalExtension();
            $bgImage->move(public_path('uploads/home/features'), $bgImageName);
        }

        // ✅ Handle Features Upload & Prepare JSON
        $featuresData = [];
        if (!empty($validatedData['features'])) {
            foreach ($validatedData['features'] as $index => $feature) {
                $featureImageName = null;
                if (isset($feature['image'])) {
                    $file = $feature['image'];
                    $featureImageName = time() . rand(100, 999) . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home/features'), $featureImageName);
                }
                $featuresData[] = [
                    'image' => $featureImageName,
                    'name' => $feature['name'],
                ];
            }
        }

        // ✅ Save Data to DB
        $homeFeature = new HomeFeatures();
        $homeFeature->image = $bgImageName;
        $homeFeature->description = $validatedData['description'];
        $homeFeature->features = json_encode($featuresData); 
        $homeFeature->inserted_by = Auth::id();
        $homeFeature->inserted_at = Carbon::now();
        $homeFeature->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-home-features.index')
            ->with('message', 'Features added successfully!');
    }

    public function edit($id)
    {
        $features = HomeFeatures::findOrFail($id);
        return view('backend.home.features.edit', compact('features'));
    }

    public function update(Request $request, $id)
    {
        $homeFeature = HomeFeatures::findOrFail($id);

        // Reindex features array to continuous keys
        if ($request->has('features')) {
            $request->merge(['features' => array_values($request->features)]);
        }

        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'description' => 'required|string',
            'features' => 'required|array|min:1',
            'features.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'features.*.name' => 'required|string|max:255',
        ], [
            'description.required' => 'Description is required.',
            'features.required' => 'At least one feature is required.',
            'features.*.name.required' => 'Feature name is required.',
        ]);

        // Background image
        if ($request->hasFile('image')) {
            $bgImage = $request->file('image');
            $bgImageName = time() . rand(100, 999) . '.' . $bgImage->getClientOriginalExtension();
            $bgImage->move(public_path('uploads/home/features'), $bgImageName);
            $homeFeature->image = $bgImageName;
        }

        $featuresData = [];
        foreach ($validatedData['features'] as $index => $feature) {
            // 1️⃣ Keep existing image if no new upload
            $featureImageName = $feature['existing_image'] ?? null;

            // 2️⃣ Replace with new uploaded image if exists
            if ($request->hasFile("features.$index.image")) {
                $file = $request->file("features.$index.image");
                $featureImageName = time() . rand(100, 999) . '_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/home/features'), $featureImageName);
            }

            $featuresData[] = [
                'image' => $featureImageName,
                'name' => $feature['name'],
            ];
        }

        // Save
        $homeFeature->description = $validatedData['description'];
        $homeFeature->features = json_encode($featuresData);
        $homeFeature->modified_by = Auth::id();
        $homeFeature->modified_at = Carbon::now();
        $homeFeature->save();

        return redirect()->route('manage-home-features.index')->with('message', 'Features updated successfully!');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeFeatures::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-home-features.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}