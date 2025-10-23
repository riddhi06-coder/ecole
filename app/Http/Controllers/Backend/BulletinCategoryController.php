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
use App\Models\BulletinCategory;

class BulletinCategoryController extends Controller
{

    public function index()
    {
        $categories = BulletinCategory::wherenull('deleted_by')->get();
        return view('backend.bulletin.category.index', compact('categories'));
    }

    public function create(Request $request)
    {
        return view('backend.bulletin.category.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate with custom messages
        $validatedData = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB max
        ], [
            'banner_heading.required' => 'Please enter a Banner heading.',
            'category.required' => 'Please enter a Category.',
            'thumbnail.required' => 'Please upload a Banner image.',
            'thumbnail.image' => 'The file must be an image.',
            'thumbnail.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'thumbnail.max' => 'The image size must be less than 2MB.',
        ]);

        // ✅ Handle image upload
        $bannerImage = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $bannerImage);
        }


        // ✅ Generate slug from category
        $slug = Str::slug($validatedData['category']);

        // Ensure unique slug (optional but recommended)
        $count = BulletinCategory::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // ✅ Store data using Eloquent
        $bulletinCategory = new BulletinCategory();
        $bulletinCategory->banner_heading = $validatedData['banner_heading'];
        $bulletinCategory->category = $validatedData['category'];
        $bulletinCategory->banner_image = $bannerImage;
        $bulletinCategory->slug = $slug;
        $bulletinCategory->inserted_by = Auth::id();
        $bulletinCategory->inserted_at = Carbon::now();
        $bulletinCategory->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-bulletin-category.index')->with('message', 'Bulletin Category added successfully.');
    }

    public function edit($id)
    {
        $category = BulletinCategory::findOrFail($id);
        return view('backend.bulletin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Find the existing category
        $bulletinCategory = BulletinCategory::findOrFail($id);

        // ✅ Validate inputs with custom messages
        $validatedData = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // optional
        ], [
            'banner_heading.required' => 'Please enter a Banner heading.',
            'category.required' => 'Please enter a Category.',
            'thumbnail.image' => 'The file must be an image.',
            'thumbnail.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'thumbnail.max' => 'The image size must be less than 2MB.',
        ]);

        // ✅ Handle image upload (replace old image if new one uploaded)
        if ($request->hasFile('thumbnail')) {
            // Delete old image if exists
            if ($bulletinCategory->banner_image && file_exists(public_path('uploads/bulletin/' . $bulletinCategory->banner_image))) {
                unlink(public_path('uploads/bulletin/' . $bulletinCategory->banner_image));
            }

            $image = $request->file('thumbnail');
            $bannerImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $bannerImage);
            $bulletinCategory->banner_image = $bannerImage;
        }

        // ✅ Update slug if category changed
        if ($bulletinCategory->category !== $validatedData['category']) {
            $slug = Str::slug($validatedData['category']);
            $count = BulletinCategory::where('slug', 'like', "{$slug}%")->where('id', '!=', $bulletinCategory->id)->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }
            $bulletinCategory->slug = $slug;
        }

        // ✅ Update other fields
        $bulletinCategory->banner_heading = $validatedData['banner_heading'];
        $bulletinCategory->category = $validatedData['category'];
        $bulletinCategory->inserted_by = Auth::id();
        $bulletinCategory->inserted_at = Carbon::now();

        // ✅ Save changes
        $bulletinCategory->save();

        // ✅ Redirect with success message
        return redirect()->route('manage-bulletin-category.index')->with('message', 'Bulletin Category updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BulletinCategory::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-bulletin-category.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}