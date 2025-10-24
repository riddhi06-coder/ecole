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
use App\Models\BulletinListing;
use App\Models\BulletinCategory;

class BulletinListingController extends Controller
{

    public function index()
    {
        $categories = BulletinCategory::whereHas('listings', function($query) {
                $query->whereNull('deleted_by'); 
            })
            ->with(['listings' => function($query) {
                $query->whereNull('deleted_by')
                    ->orderBy('article_date', 'desc');
            }])
            ->orderBy('category')
            ->get();

        return view('backend.bulletin.listing.index', compact('categories'));
    }

    public function create()
    {
        $categories = BulletinCategory::orderBy('category')->wherenull('deleted_by')->get();
        return view('backend.bulletin.listing.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|exists:bulletin_category,id',
            'thumbnail_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'article_name' => 'required|string|max:255',
            'article_date' => 'required|date',
            'article_author' => 'required|string|max:255',
            'special_tags' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
        ], [
            'category.required' => 'Please select a Category.',
            'category.exists' => 'Selected category is invalid.',
            'thumbnail_image.required' => 'Please upload a Thumbnail image.',
            'thumbnail_image.image' => 'The file must be an image.',
            'thumbnail_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'thumbnail_image.max' => 'The image size must be less than 2MB.',
            'article_name.required' => 'Please enter an Article Name.',
            'article_date.required' => 'Please enter the Article Date.',
            'article_date.date' => 'Please enter a valid date.',
            'article_author.required' => 'Please enter an Article Author.',
            'short_desc.required' => 'Please enter a Short Description.',
        ]);

        $thumbnailImage = null;
        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $thumbnailImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $thumbnailImage);
        }

        $listing = new BulletinListing();
        $listing->category_id = $validatedData['category'];
        $listing->thumbnail_image = $thumbnailImage;
        $listing->article_name = $validatedData['article_name'];
        $listing->article_date = $validatedData['article_date'];
        $listing->article_author = $validatedData['article_author'];
        $listing->special_tags = $validatedData['special_tags'] ?? null;
        $listing->short_desc = $validatedData['short_desc'];
        $listing->slug = Str::slug($validatedData['article_name']);

        $count = BulletinListing::where('slug', 'like', $listing->slug . '%')->count();
        if ($count > 0) {
            $listing->slug .= '-' . ($count + 1);
        }

        $listing->inserted_by = Auth::id();
        $listing->inserted_at = Carbon::now();
        $listing->save();

        return redirect()->route('manage-bulletin-listing.index')->with('message', 'Bulletin listing added successfully.');
    }

    public function edit($id)
    {
        $category = BulletinListing::findOrFail($id);
        $categories = BulletinCategory::orderBy('category')->wherenull('deleted_by')->get();
        return view('backend.bulletin.listing.edit', compact('category','categories'));
    }

    public function update(Request $request, $id)
    {
        $listing = BulletinListing::findOrFail($id);

        // ✅ Validate inputs
        $validatedData = $request->validate([
            'category' => 'required|exists:bulletin_category,id',
            'thumbnail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'article_name' => 'required|string|max:255',
            'article_date' => 'required|date',
            'article_author' => 'required|string|max:255',
            'special_tags' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
        ], [
            'category.required' => 'Please select a Category.',
            'category.exists' => 'Selected category is invalid.',
            'thumbnail_image.image' => 'The file must be an image.',
            'thumbnail_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'thumbnail_image.max' => 'The image size must be less than 2MB.',
            'article_name.required' => 'Please enter an Article Name.',
            'article_date.required' => 'Please enter the Article Date.',
            'article_date.date' => 'Please enter a valid date.',
            'article_author.required' => 'Please enter an Article Author.',
            'short_desc.required' => 'Please enter a Short Description.',
        ]);

        // ✅ Handle thumbnail replacement
        if ($request->hasFile('thumbnail_image')) {
            // Delete old file if exists
            if ($listing->thumbnail_image && file_exists(public_path('uploads/bulletin/' . $listing->thumbnail_image))) {
                unlink(public_path('uploads/bulletin/' . $listing->thumbnail_image));
            }

            $image = $request->file('thumbnail_image');
            $thumbnailImage = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/bulletin'), $thumbnailImage);
            $listing->thumbnail_image = $thumbnailImage;
        }

        // ✅ Update other fields
        $listing->category_id = $validatedData['category'];
        $listing->article_name = $validatedData['article_name'];
        $listing->article_date = $validatedData['article_date'];
        $listing->article_author = $validatedData['article_author'];
        $listing->short_desc = $validatedData['short_desc'];
        $listing->special_tags = $validatedData['special_tags'] ?? null;

        // ✅ Update slug if article name changed
        $newSlug = Str::slug($validatedData['article_name']);
        if ($newSlug !== $listing->slug) {
            $count = BulletinListing::where('slug', 'like', $newSlug . '%')->where('id', '!=', $listing->id)->count();
            if ($count > 0) {
                $newSlug .= '-' . ($count + 1);
            }
            $listing->slug = $newSlug;
        }

        $listing->modified_by = Auth::id();
        $listing->modified_at = Carbon::now();
        $listing->save();

        return redirect()->route('manage-bulletin-listing.index')->with('message', 'Bulletin listing updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BulletinListing::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-bulletin-listing.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}