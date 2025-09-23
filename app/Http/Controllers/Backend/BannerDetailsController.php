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
use App\Models\Banner;

class BannerDetailsController extends Controller
{

    public function index()
    {
        $banners = Banner::whereNull('deleted_by')->get();
        return view('backend.home.banner.index', compact('banners'));
    }

    public function create(Request $request)
    {
        return view('backend.home.banner.create');
    }

    public function store(Request $request)
    {
        // ✅ Step 1: Validate request
        $validated = $request->validate([
            'thumbnail'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'thumbnail.required'      => 'Please upload a Banner image.',
            'thumbnail.image'         => 'Banner must be an image.',
            'thumbnail.mimes'         => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Banner.',
            'thumbnail.max'           => 'Banner image size must not exceed 2MB.',
        ]);

        // ✅ Step 2: Handle Banner Image upload
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $bannerImage);
        }


        // ✅ Step 4: Save to DB
        Banner::create([
            'banner_image'   => $bannerImage,
            'inserted_by'    => Auth::id(),
            'inserted_at'    => Carbon::now(),
        ]);

        // ✅ Step 5: Redirect with success message
        return redirect()->route('manage-banner-details.index')->with('message', 'Banner added successfully!');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.home.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the existing banner
        $banner = Banner::findOrFail($id);

        // ✅ Step 1: Validate request
        $validated = $request->validate([
            'thumbnail'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // optional
        ], [
            'thumbnail.image'         => 'Banner must be an image.',
            'thumbnail.mimes'         => 'Only JPG, JPEG, PNG, or WEBP formats are allowed for Banner.',
            'thumbnail.max'           => 'Banner image size must not exceed 2MB.',
        ]);

        // ✅ Step 2: Handle Banner Image upload
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/home'), $bannerImage);
            $banner->banner_image = $bannerImage;
        }

    
        // ✅ Step 4: Update other fields
        $banner->modified_by     = Auth::id();
        $banner->modified_at     = Carbon::now();

        $banner->save();

        // ✅ Step 5: Redirect with success message
        return redirect()->route('manage-banner-details.index')
                        ->with('message', 'Banner updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Banner::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-banner-details.index')->with('message', 'Banner deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}