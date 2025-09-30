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
use App\Models\VirtualTour;

class VirtualController extends Controller
{

    public function index()
    {
        $virtualTours = VirtualTour::wherenull('deleted_by')->get();
        return view('backend.campus.virtual.index', compact('virtualTours'));
    }

    public function create(Request $request)
    {
        return view('backend.campus.virtual.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading' => 'required|string|max:255',
                'banner'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
                'video_url'      => 'required|url|max:500',
            ], [
                'banner_heading.required' => 'Banner Heading is required.',
                'banner.required'         => 'Banner Image is required.',
                'banner.image'            => 'Please upload a valid image file.',
                'banner.mimes'            => 'Only jpg, jpeg, png, webp files are allowed.',
                'banner.max'              => 'Banner Image must not exceed 2MB.',
                'video_url.required'      => 'Video URL is required.',
                'video_url.url'           => 'Please enter a valid Video URL.',
            ]);

            // ✅ Handle banner image upload
            $bannerName = null;
            if ($request->hasFile('banner')) {
                $banner = $request->file('banner');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/campus-life'), $bannerName);
            }

            // ✅ Save to database
            $virtualTour = new VirtualTour();
            $virtualTour->banner_heading = $request->banner_heading;
            $virtualTour->banner_image   = $bannerName;
            $virtualTour->video_url      = $request->video_url;
            $virtualTour->inserted_by    = Auth::id();
            $virtualTour->inserted_at    = Carbon::now();
            $virtualTour->save();

            return redirect()->route('manage-virtual-tour.index')
                            ->with('message', 'Virtual Tour added successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; // Let Laravel handle validation errors

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $virtual = VirtualTour::findOrFail($id);
        return view('backend.campus.virtual.edit', compact('virtual'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        try {
            // ✅ Find record
            $virtualTour = VirtualTour::findOrFail($id);

            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading' => 'required|string|max:255',
                'banner'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'video_url'      => 'required|url|max:500',
            ], [
                'banner_heading.required' => 'Banner Heading is required.',
                'banner.image'            => 'Please upload a valid image file.',
                'banner.mimes'            => 'Only jpg, jpeg, png, webp files are allowed.',
                'banner.max'              => 'Banner Image must not exceed 2MB.',
                'video_url.required'      => 'Video URL is required.',
                'video_url.url'           => 'Please enter a valid Video URL.',
            ]);

            // ✅ Handle banner image upload (replace if new one is uploaded)
            if ($request->hasFile('banner')) {
                $banner = $request->file('banner');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/campus-life'), $bannerName);

                // Delete old banner if exists
                if ($virtualTour->banner_image && file_exists(public_path('uploads/campus-life/' . $virtualTour->banner_image))) {
                    unlink(public_path('uploads/campus-life/' . $virtualTour->banner_image));
                }

                $virtualTour->banner_image = $bannerName;
            }

            // ✅ Update fields
            $virtualTour->banner_heading = $request->banner_heading;
            $virtualTour->video_url      = $request->video_url;
            $virtualTour->modified_by   = Auth::id();
            $virtualTour->modified_at   = Carbon::now();
            $virtualTour->save();

            return redirect()->route('manage-virtual-tour.index')
                            ->with('message', 'Virtual Tour updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; // Let Laravel handle validation errors

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = VirtualTour::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-virtual-tour.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}