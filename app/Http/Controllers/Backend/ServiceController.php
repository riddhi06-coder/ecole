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
use App\Models\Service;

class ServiceController extends Controller
{

    public function index()
    {
        $service = Service::orderBy('id', 'asc')->wherenull('deleted_by')->get();
        return view('backend.campus.service.index', compact('service'));
    }

    public function create(Request $request)
    {
        return view('backend.campus.service.create');
    }

    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'   => 'nullable|string|max:255',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'title'            => 'required|string|max:255',
                'description'      => 'required|string|max:5000',
            ], [
                'banner_heading.max'       => 'Banner Heading must not exceed 255 characters.',
                'image.image'              => 'Please upload a valid Banner image.',
                'image.mimes'              => 'Banner image must be a file of type: jpg, jpeg, png, webp, svg.',
                'image.max'                => 'Banner image size must not exceed 2MB.',
                'title.required'           => 'Title is required.',
                'title.max'                => 'Title must not exceed 255 characters.',
                'description.required'     => 'Description is required.',
                'description.max'          => 'Description must not exceed 5000 characters.',
            ]);

            // ✅ Handle Banner Image Upload
            $bannerName = null;
            if ($request->hasFile('image')) {
                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/campus-life'), $bannerName);
            }


            // ✅ Save Record to Database
            $sports = new Service(); // Make sure the model exists
            $sports->banner_heading   = $request->banner_heading;
            $sports->banner_image     = $bannerName;
            $sports->title            = $request->title;
            $sports->description      = $request->description;
            $sports->inserted_by      = Auth::id();
            $sports->inserted_at      = Carbon::now();
            $sports->save();

            return redirect()->route('manage-service-learning.index')
                            ->with('message', 'Sports Activity record added successfully.');

        } catch (\Illuminate\Validation\ValidationException $ve) {
            throw $ve; // Let Laravel handle validation errors

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function edit($id)
    {
        $sports = Service::findOrFail($id);
        return view('backend.campus.service.edit', compact('sports'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the record
            $sports = Service::findOrFail($id);

            // ✅ Validate input
            $validated = $request->validate([
                'banner_heading'   => 'nullable|string|max:255',
                'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                'title'            => 'required|string|max:255',
                'description'      => 'required|string|max:5000',
            ], [
                'banner_heading.max'       => 'Banner Heading must not exceed 255 characters.',
                'image.image'              => 'Please upload a valid Banner image.',
                'image.mimes'              => 'Banner image must be a file of type: jpg, jpeg, png, webp, svg.',
                'image.max'                => 'Banner image size must not exceed 2MB.',
                'title.required'           => 'Title is required.',
                'title.max'                => 'Title must not exceed 255 characters.',
                'description.required'     => 'Description is required.',
                'description.max'          => 'Description must not exceed 5000 characters.',
            ]);

            // ✅ Handle Banner Image Upload
            if ($request->hasFile('image')) {
                // Delete old banner image if exists
                if ($sports->banner_image && file_exists(public_path('uploads/campus-life/' . $sports->banner_image))) {
                    unlink(public_path('uploads/campus-life/' . $sports->banner_image));
                }

                $banner = $request->file('image');
                $bannerName = time() . '_' . rand(10, 999) . '.' . $banner->getClientOriginalExtension();
                $banner->move(public_path('uploads/campus-life'), $bannerName);
                $sports->banner_image = $bannerName;
            }


            // ✅ Update other fields
            $sports->banner_heading   = $request->banner_heading;
            $sports->title            = $request->title;
            $sports->description      = $request->description;
            $sports->modified_by      = Auth::id();
            $sports->modified_at      = Carbon::now();
            $sports->save();

            return redirect()->route('manage-service-learning.index')
                            ->with('message', 'Sports Activity record updated successfully.');

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
            $industries = Service::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-service-learning.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}