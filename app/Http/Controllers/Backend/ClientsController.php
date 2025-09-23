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
use App\Models\Clients;

class ClientsController extends Controller
{

    public function index()
    {
        $clients = Clients::wherenull('deleted_by')->get();
        return view('backend.home.clients.index', compact('clients'));
    }

    public function create(Request $request)
    {
        return view('backend.home.clients.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate input
        $validatedData = $request->validate([
            'features' => 'required|array|min:1',
            'features.*.image' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ], [
            'features.required' => 'At least one feature is required.',
            'features.*.image.required' => 'Feature image is required.',
            'features.*.image.image' => 'Uploaded file must be an image.',
            'features.*.image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'features.*.image.max' => 'Image size must not exceed 2MB.',
        ]);

        $featuresData = [];

        // ✅ Handle multiple feature images
        if ($request->has('features')) {
            foreach ($request->features as $index => $feature) {
                if (isset($feature['image']) && $feature['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $file = $feature['image'];
                    $imageName = time() . '_' . $index . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home'), $imageName);

                    // Save data for JSON
                    $featuresData[] = [
                        'image' => $imageName,
                    ];
                }
            }
        }

        // ✅ Save to DB (json_encode)
        $homeFeature = new Clients();
        $homeFeature->clients = json_encode($featuresData); 
        $homeFeature->inserted_by = Auth::id();
        $homeFeature->inserted_at = now();
        $homeFeature->save();

        // ✅ Redirect with success
        return redirect()->route('manage-clients.index')
            ->with('message', 'Clients added successfully!');
    }

    public function edit($id)
    {
        $clients = Clients::findOrFail($id);
        return view('backend.home.clients.edit', compact('clients'));
    }


    public function update(Request $request, $id)
    {
        $clients = Clients::findOrFail($id);

        // Validate input
        $validatedData = $request->validate([
            'features' => 'required|array|min:1',
            'features.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'features.*.existing_image' => 'nullable|string',
        ], [
            'features.required' => 'At least one feature is required.',
            'features.*.image.image' => 'Uploaded file must be an image.',
            'features.*.image.mimes' => 'Image must be in JPG, JPEG, PNG, WEBP, or SVG format.',
            'features.*.image.max' => 'Image size must not exceed 2MB.',
        ]);

        $featuresData = []; // rebuild from submitted rows only

        if (!empty($validatedData['features'])) {
            foreach ($validatedData['features'] as $index => $feature) {
                $imageName = null;

                // Use existing image if it exists (row not removed)
                if (!empty($feature['existing_image'])) {
                    $imageName = $feature['existing_image'];
                }

                // Upload new image if provided
                if (isset($feature['image']) && $feature['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $file = $feature['image'];
                    $imageName = time() . '_' . $index . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/home'), $imageName);
                }

                // Only include row if it has an image
                if ($imageName) {
                    $featuresData[] = ['image' => $imageName];
                }
            }
        }

        // Save updated JSON data
        $clients->clients = json_encode($featuresData);
        $clients->modified_by = Auth::id();
        $clients->modified_at = now();
        $clients->save();

        return redirect()->route('manage-clients.index')
            ->with('message', 'Clients updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Clients::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-clients.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }




}